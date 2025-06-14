<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gemba;
use App\Models\ActionList;
use App\Models\User;
use Auth;

class ManagerController extends Controller
{
    public function index(Gemba $gemba)
    {
        $actions = $gemba->getactions;
        $manager = Auth::user();
        $gembas = Gemba::where('manager_id', $manager->id)->get();
        $actions = ActionList::where('manager_id', $manager->id)->get();
        $managers = User::role('manager')->where('id', '!=', $manager->id)->get();

        return view('manager.dashboard', compact('gembas', 'actions', 'managers'));
    }

    public function updateGembaManager(Request $request, Gemba $gemba)
    {
        $gemba->update(['manager_id' => $request->manager_id]);
        return redirect()->route('manager.dashboard')->with('success', 'Gemba updated successfully');
    }

    public function showGembaActions(Gemba $gemba)
    {
        $actions = $gemba->getactions;
        return view('manager.gemba_actions', compact('gemba', 'actions'));
    }
}
