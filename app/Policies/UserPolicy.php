<?php

namespace App\Policies;

use App\Conference;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Role;

class UserPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can become the
     * specified user (loginAs)
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function loginAs(User $user, User $model)
    {
        if ($user->isAdmin()) {
            return true;
        } else if (
            $user->isChair()
            && !$model->isAdmin()
            && !$model->isChair()
        ) {
            // User has to be chair and the target user
            // must not be admin or chair

            // Further more the auth user and the target
            // have to share at least one common conference
            $conferencesOfModel = $model->conferences;
            $manageableConferences = $user->conferencesAsChairOrCaptain();
            $conferencesTheyShare = $conferencesOfModel->intersect($manageableConferences);
            return $conferencesTheyShare->isNotEmpty();
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can view the own
     * user object
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewSelf(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view a list of users.
     * Which user in particular is decided by view below
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin() || $user->isChair();
    }

    /**
     * Determine whether the user can view the user's bids.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @param  \App\Conference  $conference
     * @return mixed
     */
    public function viewBidsForConference(User $user, User $model, Conference $conference)
    {
        if (
            $user->isAdmin()
            || $user->isChair($conference)
            || $user->isCaptain($conference)
            || $user->id == $model->id // User can view self
        ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can view the user's notifications.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @param  \App\Conference  $conference
     * @return mixed
     */
    public function viewNotificationsForConference(User $user, User $model, Conference $conference)
    {
        if (
            $user->isAdmin()
            || $user->isChair($conference)
            || $user->isCaptain($conference)
            || $user->id == $model->id // User can view self
        ) {
            return true;
        } else {
            return false;
        }
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
}