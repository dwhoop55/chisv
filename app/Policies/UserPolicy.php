<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Role;

class UserPolicy
{
    use HandlesAuthorization;

    // /**
    //  * Determine whether the user can view any models.
    //  *
    //  * @param  \App\User  $user
    //  * @return mixed
    //  */
    // public function viewAny(User $user)
    // {
    //     return $this->index($user);
    // }

    /**
     * Determine whether the user can view a list of users.
     * Which user in particular is decided by view below
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function index(User $user)
    {
        // Note, this only is for if the user can access
        // the index page. Which user is displayed is
        // up to the view method below
        return $user->isAdmin() || $user->isChair() || $user->isCaptain();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        if ($user->id == $model->id) {
            // A user can always view itself
            return true;
        } else if ($user->isAdmin()) {
            // An admin can always view everyone
            return true;
        } else if ($user->isChair() || $user->isCaptain()) {
            // This is more tricky:
            // Only show users, which share conferences
            // the auth()->user is chair or captain for
            $conferencesOfModel = $model->conferences;
            $manageableConferences = $user->conferencesAsChairOrCaptain();
            $conferencesTheyShare = $conferencesOfModel->intersect($manageableConferences);
            return $conferencesTheyShare->isNotEmpty();
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        // When someone can view a user
        // updating should also be possible
        return $this->view($user, $model);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        return $user->isAdmin() && $user->id != $model->id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function restore(User $user, User $model)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function forceDelete(User $user, User $model)
    {
        return $user->isAdmin() && $user->id != $model->id;
    }
}