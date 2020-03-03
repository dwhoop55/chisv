<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Notifications\DatabaseNotification;

class NotificationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any database notifications.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the database notification.
     *
     * @param  \App\User  $user
     * @param  Illuminate\Notifications\DatabaseNotification  $databaseNotification
     * @return mixed
     */
    public function view(User $user, DatabaseNotification $databaseNotification)
    {
        $notifiable = $databaseNotification->notifiable;

        if (
            $user->isAdmin() ||
            ($notifiable instanceof User && $notifiable->id == $user->id)
        ) {
            return true;
        }
    }

    // /**
    //  * Determine whether the user can create database notifications.
    //  *
    //  * @param  \App\User  $user
    //  * @return mixed
    //  */
    // public function create(User $user)
    // {
    //     //
    // }

    /**
     * Determine whether the user can update the database notification.
     *
     * @param  \App\User  $user
     * @param  Illuminate\Notifications\DatabaseNotification  $databaseNotification
     * @return mixed
     */
    public function update(User $user, DatabaseNotification $databaseNotification)
    {
        $notifiable = $databaseNotification->notifiable;

        if (
            $user->isAdmin() ||
            ($notifiable instanceof User && $notifiable->id == $user->id)
        ) {
            return true;
        }
    }

    // /**
    //  * Determine whether the user can delete the database notification.
    //  *
    //  * @param  \App\User  $user
    //  * @param  Illuminate\Notifications\DatabaseNotification  $databaseNotification
    //  * @return mixed
    //  */
    // public function delete(User $user, DatabaseNotification $databaseNotification)
    // {
    //     //
    // }

}