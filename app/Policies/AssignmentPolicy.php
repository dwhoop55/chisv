<?php

namespace App\Policies;

use App\Assignment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AssignmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any assignments.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if ($user->isAdmin() || $user->isChair() || $user->isCaptain()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can view the assignment.
     *
     * @param  \App\User  $user
     * @param  \App\Assignment  $assignment
     * @return mixed
     */
    public function view(User $user, Assignment $assignment)
    {
        if (
            $user->isAdmin() ||
            $user->isChair($assignment->task->conference) ||
            $user->isCaptain($assignment->task->conference) ||
            $user->id == $assignment->user->id
        ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can create assignments.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->isAdmin() || $user->isChair() || $user->isCaptain()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can create a specific assignments.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function createThis(User $user, Assignment $assignment)
    {
        if (
            $user->isAdmin() ||
            $user->isChair($assignment->task->conference) ||
            $user->isCaptain($assignment->task->conference)
        ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can update the assignment.
     *
     * @param  \App\User  $user
     * @param  \App\Assignment  $assignment
     * @return mixed
     */
    public function update(User $user, Assignment $assignment)
    {
        if (
            $user->isAdmin() ||
            $user->isChair($assignment->task->conference) ||
            $user->isCaptain($assignment->task->conference)
        ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can delete the assignment.
     *
     * @param  \App\User  $user
     * @param  \App\Assignment  $assignment
     * @return mixed
     */
    public function delete(User $user, Assignment $assignment)
    {
        if (
            $user->isAdmin() ||
            $user->isChair($assignment->task->conference) ||
            $user->isCaptain($assignment->task->conference)
        ) {
            return true;
        } else {
            return false;
        }
    }
}