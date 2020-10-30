<?php

namespace App\Policies;

use App\User;
use App\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Role;

class PermissionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any permissions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the permission.
     *
     * @param  \App\User  $user
     * @param  \App\Permission  $permission
     * @return mixed
     */
    public function view(User $user, Permission $permission)
    {
    }

    /**
     * Determine whether the user can create permissions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->isAdmin() || $user->isChair()) {
            return true;
        }
    }

    /**
     * Determine whether the user can create a specific permission.
     *
     * @param  \App\User  $user
     * @param  \App\Permission  $permission
     * @return mixed
     */
    public function createThis(User $user, Permission $permission)
    {
        if ($user->isAdmin()) {
            return true;
        }

        $conference = $permission->conference;
        if (
            $user->isChair($conference)
            && $permission->role_id != Role::byName('admin')->id
        ) {
            // If the user is chair for the conference in the permission
            // and is not trying to grant admin, we allow
            return true;
        }

        if (
            $user->isCaptain($conference)
            && $permission->role_id == Role::byName('sv')->id
        ) {
            // If the user is captain for the conference in the permission
            // and is creating sv, we allow
            return true;
        }
    }

    /**
     * Determine whether the user can update the permission.
     *
     * @param  \App\User  $user
     * @param  \App\Permission  $permission
     * @return mixed
     */
    public function update(User $user, Permission $permission)
    {
        $conference = $permission->conference;

        if (
            $user->isAdmin()
            && ($permission->role_id != Role::byName('admin')->id
                ||  $user->id != $permission->user_id)
        ) {
            // An admin can always change permissions as long
            // its not the own admin permission
            return true;
        }

        if (
            $conference
            && ($user->isChair($conference))
            && $permission->role_id != Role::byName('admin')->id
        ) {
            // Allow update if the permission is associated as chair to user
            // and not the admin role
            return true;
        }

        if (
            $conference
            && ($user->isCaptain($conference))
            && $permission->role == Role::byName('sv')
        ) {
            // Allow update if the permission is associated as captain to user
            // and is the sv role
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the permission.
     *
     * @param  \App\User  $user
     * @param  \App\Permission  $permission
     * @return mixed
     */
    public function delete(User $user, Permission $permission)
    {
        $conference = $permission->conference;

        if ($user->isAdmin() && ($permission->role != Role::byName('admin')
            ||  $user->id != $permission->user->id)) {
            // An admin can always delete permission, as long
            // it's not the own admin permission
            return true;
        }

        if (
            $conference && ($user->isChair($conference) || $user->isCaptain($conference))
        ) {
            // Allow delete if the user is chair or captain
            // for the conference in the permission
            return true;
        }

        return false;
    }

    // /**
    //  * Determine whether the user can restore the permission.
    //  *
    //  * @param  \App\User  $user
    //  * @param  \App\Permission  $permission
    //  * @return mixed
    //  */
    // public function restore(User $user, Permission $permission)
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can permanently delete the permission.
    //  *
    //  * @param  \App\User  $user
    //  * @param  \App\Permission  $permission
    //  * @return mixed
    //  */
    // public function forceDelete(User $user, Permission $permission)
    // {
    //     //
    // }
}