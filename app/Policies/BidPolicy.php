<?php

namespace App\Policies;

use App\Bid;
use App\State;
use App\Task;
use App\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\HandlesAuthorization;

class BidPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any bids.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the bid.
     *
     * @param  \App\User  $user
     * @param  \App\Bid  $bid
     * @return mixed
     */
    public function view(User $user, Bid $bid)
    {
        //
    }

    /**
     * Determine whether the user can create a bid
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->isAdmin()) {
            // Allow admin to always bid
            return true;
        } else if ($user->isSv()) {
            // Allow bidding if the user is SV
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can create a bid for given task
     *
     * @param  \App\User  $user
     * @param  \App\Task  $task
     * @return mixed
     */
    public function createForTask(User $user, Task $task)
    {
        $conference = $task->conference;
        if ($task->users->contains($user)) {
            // We only allow one bid per user per task
            return false;
        } else if ($user->isAdmin()) {
            // Allow admin to always bid
            return true;
        } else if (
            $user->isSv($conference, State::byName('accepted')) &&
            $conference->bidding_enabled &&
            $conference->bidding_until && // must be set
            new Carbon($task->date) <= new Carbon($conference->bidding_until)
        ) {
            // Allow bidding if the user is SV for the task's conference
            // and the bidding is open
            // and the task is within the bidable date range
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can update the bid.
     *
     * @param  \App\User  $user
     * @param  \App\Bid  $bid
     * @return mixed
     */
    public function update(User $user, Bid $bid)
    {
        $task = $bid->task;
        $conference = $task->conference;
        if ($user->isAdmin()) {
            return true;
        } else if (
            $user->isSv($conference) &&
            $conference->bidding_enabled &&
            $conference->bidding_until && // must be set
            new Carbon($task->date) <= new Carbon($conference->bidding_until)
        ) {
            // Allow bidding if the user is SV for the task's conference
            // and the bidding is open
            // and the task is within the bidable date range
            return true;
        }
    }

    /**
     * Determine whether the user can delete the bid.
     *
     * @param  \App\User  $user
     * @param  \App\Bid  $bid
     * @return mixed
     */
    public function delete(User $user, Bid $bid)
    {
        //
    }

    /**
     * Determine whether the user can restore the bid.
     *
     * @param  \App\User  $user
     * @param  \App\Bid  $bid
     * @return mixed
     */
    public function restore(User $user, Bid $bid)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the bid.
     *
     * @param  \App\User  $user
     * @param  \App\Bid  $bid
     * @return mixed
     */
    public function forceDelete(User $user, Bid $bid)
    {
        //
    }
}