<?php

/**
 * This policy class uses harcoded strings and ids for checking states
 * It's not pretty, but there is no other way to limit database calls
 * So that the task list always loads fast
 */

namespace App\Policies;

use App\Assignment;
use App\Bid;
use App\Conference;
use App\State;
use App\Task;
use App\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

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
    public function createForTask(User $user, Task $task, $skip = null)
    {
        if ($task->usersWithBid->contains($user)) {
            // We only allow one bid per user per task
            return false;
        }

        return $this->canBidTask($user, $task, $skip);
    }

    /**
     * Determine whether the user can update the bid.
     *
     * @param  \App\User  $user
     * @param  \App\Bid  $bid
     * @return mixed
     */
    public function update(User $user, Bid $bid, $skip = null)
    {
        if ($bid->state->name != "placed") {
            // If a bid is not in state 'placed'
            // we don't allow changing anything
            // about the bid
            return false;
        }
        return $this->canBidTask($user, $bid->task, $skip);
    }

    public function canBidTask(User $user, Task $task, $skip = null)
    {
        $skip = $skip ?? collect();
        $conference = $task->conference;
        if (
            ($skip->contains("stateCheck") || $user->isSv($conference, State::byName('accepted'))) &&
            $conference->bidding_enabled &&
            $conference->bidding_start && // must be set
            $conference->bidding_end && // must be set
            new Carbon($task->date) >= new Carbon($conference->bidding_start) &&
            new Carbon($task->date) <= new Carbon($conference->bidding_end) &&
            ($skip->contains("assignmentsCheck") || !$user->assignmentFor($task))
        ) {
            // Allow bidding if the user is SV for the task's conference and 'accepted',
            // the bidding is open
            // the task is not before bidding_start
            // the task is not after bidding_end
            // the user is not already assigned to the task
            return true;
        } else {
            return false;
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
        return $this->canBidTask($user, $bid->task);
    }
}