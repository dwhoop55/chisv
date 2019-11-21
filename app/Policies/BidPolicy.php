<?php

namespace App\Policies;

use App\Bid;
use App\Conference;
use App\Task;
use App\User;
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
     * Determine whether the user can create a bid for given task
     *
     * @param  \App\User  $user
     * @param  \App\Task  $task
     * @return mixed
     */
    public function create(User $user, Task $task)
    {
        if ($task->users->contains($user)) {
            // We only allow one bid per user per task
            return false;
        } else if ($user->isAdmin()) {
            // Allow admin to always bid
            return true;
        } else if ($user->isSv($task->conference)) {
            // Allow bidding if the user is SV for the task's conference
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can create bid for a conference.
     *
     * @param  \App\User  $user
     * @param  \App\Conferece  $conference
     * @return mixed
     */
    public function createForConference(User $user, Bid $bid, Conference $conference)
    {
        if ($user->isAdmin()) {
            return true;
        } else if ($user->isSv($conference)) {
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
    { }

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