<?php

namespace App\Policies;

use App\User;
use App\Image;
use Illuminate\Auth\Access\HandlesAuthorization;

class ImagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any images.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the image.
     *
     * @param  \App\User  $user
     * @param  \App\Image  $image
     * @return mixed
     */
    public function view(User $user, Image $image)
    {
        //
    }

    /**
     * Determine whether the user can create images.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can create a specific image.
     *
     * @param  \App\User  $user
     * @param  \App\Permission  $permission
     * @return mixed
     */
    public function createThis(User $user, Image $image)
    {
        $for = $image->owner;
        if (!$for) {
            return false;
        }

        // Admin can do everything
        if ($user->isAdmin()) {
            return true;
        }

        // Chair can create image when associated for
        // image->owner (conference)
        if ($user->isChair($for)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the image.
     *
     * @param  \App\User  $user
     * @param  \App\Image  $image
     * @return mixed
     */
    public function update(User $user, Image $image)
    {
        if ($user->isAdmin()) {
            return true;
        }

        // Allow update of own avatar
        if ($user->avatar && $user->avatar->id == $image->id) {
            return true;
        }

        // Allow updating of conference owner images for the
        // associated chair
        if ($user->isChair($image->owner)) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the image.
     *
     * @param  \App\User  $user
     * @param  \App\Image  $image
     * @return mixed
     */
    public function delete(User $user, Image $image)
    {
        if ($user->isAdmin()) {
            return true;
        }

        // Allow deletion of own avatar
        if ($user->avatar && $user->avatar->id == $image->id) {
            return true;
        }

        // Allow if the user is chair for the image owners conference
        if ($user->isChair($image->owner)) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the image.
     *
     * @param  \App\User  $user
     * @param  \App\Image  $image
     * @return mixed
     */
    public function restore(User $user, Image $image)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the image.
     *
     * @param  \App\User  $user
     * @param  \App\Image  $image
     * @return mixed
     */
    public function forceDelete(User $user, Image $image)
    {
        //
    }
}