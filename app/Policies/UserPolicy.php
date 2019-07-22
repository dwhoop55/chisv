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
    //     //
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
        return $user->isAdmin() || $user->isChair();
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
            // Only allow view for users which are
            // enrolled for a conference the user
            // has the chair/daycaptain role for
            $conferencesAsSv = $model->conferencesByRole(Role::byName('sv'));
            $conferencesAsChair = $user->conferencesByRole(Role::byName('chair'));
            foreach ($conferencesAsChair as $conferenceChair) {
                if ($conferencesAsSv->contains($conferenceChair)) {
                    // As soon as the user can view at least one
                    // model we return true. Which conference we later show
                    // will be handled somewhere else
                    return true;
                }
            }
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
        //
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
        //
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
        //
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
        //
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
        //
    }
}