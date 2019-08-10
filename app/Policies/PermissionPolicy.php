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
    { }

    /**
     * Determine whether the user can create permissions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->idAdmin()) {
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

        if ($user->isAdmin() && ($permission->role_id != Role::byName('admin')->id
            ||  $user->id != $permission->user->id)) {
            // An admin can always change permissions as long
            // its not the own admin permission
            return true;
        }

        if (
            $conference && ($user->isChair($conference) || $user->isCaptain($conference)
                && ($permission->role_id == $permission->role_id))
        ) {
            // Allow update if the user is chair or captain
            // for the conference in the permission and
            // the permission has the same role level
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