<?php

namespace App\Policies;

use App\Conference;
use App\Task;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any tasks.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        // Everyone can all task (we filter in the controller)
        return true;
    }

    /**
     * Determine whether the user can view the task.
     *
     * @param  \App\User  $user
     * @param  \App\Task  $task
     * @return mixed
     */
    public function view(User $user, Task $task)
    {
        if ($user->isAdmin()) {
            return true;
        } else if (
            // User is chair, captain or sv for the task's conference
            $user->isChair($task->conference) ||
            $user->isCaptain($task->conference) ||
            $user->isSv($task->conference)
        ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can create tasks.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin() || $user->isChair();
    }

    /**
     * Determine whether the user can create tasks
     * for a given conference.
     *
     * @param  \App\User  $user
     * @param  \App\Conference  $conference
     * @return mixed
     */
    public function createForConference(User $user, Task $task, Conference $conference)
    {
        return $user->isAdmin() || $user->isChair($conference);
    }

    /**
     * Determine whether the user can create a specific tasks.
     *
     * @param  \App\User  $user
     * @param  \App\Task  $task
     * @return mixed
     */
    public function createThis(User $user, Task $task)
    {
        return $user->isAdmin() || $user->isChair($task->conference);
    }

    /**
     * Determine whether the user can update the task.
     *
     * @param  \App\User  $user
     * @param  \App\Task  $task
     * @return mixed
     */
    public function update(User $user, Task $task)
    {
        if ($user->isAdmin()) {
            return true;
        } else if ($user->isChair($task->conference)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can delete the task.
     *
     * @param  \App\User  $user
     * @param  \App\Task  $task
     * @return mixed
     */
    public function delete(User $user, Task $task)
    {
        if ($user->isAdmin()) {
            return true;
        } else if ($user->isChair($task->conference)) {
            return true;
        } else {
            return false;
        }
    }
}