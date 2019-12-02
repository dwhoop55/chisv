<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any jobs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if ($user->isAdmin() || $user->isChair()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view a specific job.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
        if ($user->isAdmin() || $user->isChair()) {
            return true;
        }
    }
}