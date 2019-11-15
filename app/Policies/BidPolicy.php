<?php

namespace App\Policies;

use App\Bid;
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
     * Determine whether the user can create bids.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
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
        //
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
