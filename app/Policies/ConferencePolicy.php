<?php

namespace App\Policies;

use App\User;
use App\Conference;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConferencePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the conference.
     *
     * @param  \App\User  $user
     * @param  \App\Conference  $conference
     * @return mixed
     */
    public function view(User $user, Conference $conference)
    {
        // Everyone logged in should be able to view a conference
        return $user ? true : false;
    }

    /**
     * Determine whether the user can create conferences.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the conference.
     *
     * @param  \App\User  $user
     * @param  \App\Conference  $conference
     * @return mixed
     */
    public function update(User $user, Conference $conference)
    {
        return $user->isAdmin() || $user->isChair($conference);
    }

    /**
     * Determine whether the user can delete the conference.
     *
     * @param  \App\User  $user
     * @param  \App\Conference  $conference
     * @return mixed
     */
    public function delete(User $user, Conference $conference)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the conference.
     *
     * @param  \App\User  $user
     * @param  \App\Conference  $conference
     * @return mixed
     */
    public function restore(User $user, Conference $conference)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the conference.
     *
     * @param  \App\User  $user
     * @param  \App\Conference  $conference
     * @return mixed
     */
    public function forceDelete(User $user, Conference $conference)
    {
        return $user->isAdmin();
    }
}