<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = $request->user();
        $roles = explode('|', $role);

        if (!$user || !$user->hasAnyRole($roles)) {
            return redirect()->back()->with('error', 'You are not authorised');
        }

        return $next($request);
    }
}
