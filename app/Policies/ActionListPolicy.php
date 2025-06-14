<?php

namespace App\Policies;

use App\Models\ActionList;
use App\Models\User;

class ActionListPolicy
{
    /**
     * Determine if the given action list can be updated by the user.
     */
    public function update(User $user, ActionList $actionList)
    {
        $authorized = $user->hasRole('admin') || $user->id === $actionList->manager_id || $user->id === $actionList->gemba->manager_id;

        if (!$authorized) {
            return redirect()->back()->with('error', 'You are not authorised')->send();
        }

        return $authorized;
    }

    /**
     * Determine if the given action list can be deleted by the user.
     */
    public function delete(User $user, ActionList $actionList)
    {
        $authorized = $user->hasRole('admin') || $user->id === $actionList->manager_id || $user->id === $actionList->gemba->manager_id;

        if (!$authorized) {
            return redirect()->back()->with('error', 'You are not authorised')->send();
        }

        return $authorized;
    }
}



