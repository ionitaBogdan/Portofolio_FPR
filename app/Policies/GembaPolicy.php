<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Gemba;
use Illuminate\Auth\Access\HandlesAuthorization;

class GembaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the gemba.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Gemba  $gemba
     * @return mixed
     */
    public function update(User $user, Gemba $gemba)
    {
        // Allow update if the user is an admin
        if ($user->hasRole('admin')) {
            return true;
        }

        // Allow update if the user is the manager assigned to the gemba
        return $user->id === $gemba->manager_id;
    }
}

