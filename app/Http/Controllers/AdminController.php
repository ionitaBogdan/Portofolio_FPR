<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Gemba; // Assuming Gemba is the model for gembas
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Fetch admin user separately
        $adminUser = User::role('admin')->first();

        // Fetch other users based on search and sorting criteria
        $query = User::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('sort_by') && $request->filled('sort_order')) {
            $query->orderBy($request->sort_by, $request->sort_order);
        }

        // Exclude admin user from the list
        $users = $query->whereDoesntHave('roles', function ($q) {
            $q->where('name', 'admin');
        })->get();

        // Prepend admin user to the beginning of the users collection
        if ($adminUser) {
            $users->prepend($adminUser);
        }

        return view('admin.dashboard', compact('users'));
    }

    public function updateRoles(Request $request)
    {
        $errors = [];

        foreach ($request->roles as $userId => $role) {
            $user = User::findOrFail($userId);

            if ($role == 'worker' && $user->hasRole('manager')) {
                // Check if the manager has any assigned gembas
                $assignedGembas = Gemba::where('manager_id', $user->id)->count();

                if ($assignedGembas > 0) {
                    $errors[] = "Cannot change the role of {$user->name} because they have assigned gembas.";
                    continue;
                }
            }

            $user->syncRoles([$role]);
        }

        if (!empty($errors)) {
            return redirect()->route('admin.dashboard')->withErrors($errors);
        }

        return redirect()->route('admin.dashboard')->with('success', 'User roles updated successfully');
    }

    public function deleteUser(User $user)
    {
        try {
            // Check if user has 'admin' role
            if ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard')->withErrors('Cannot delete user with admin role');
            }

            // Delete user roles
            $user->roles()->detach();

            // Optionally, delete associated records or relationships
            // For example, if Gemba is associated with the user
            // Gemba::where('manager_id', $user->id)->delete();

            // Delete the user
            $user->delete();

            return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            // Handle any exceptions or errors
            return redirect()->route('admin.dashboard')->withErrors('Failed to delete user: ' . $e->getMessage());
        }
    }

    public function changeRole(Request $request, User $user)
    {
        // Validate the incoming request
        $request->validate([
            'role' => 'required|exists:roles,name',
        ]);

        // Remove all current roles and assign the new role
        $user->syncRoles($request->role);

        return response()->json([
            'message' => 'Role changed successfully',
        ]);
    }
}
