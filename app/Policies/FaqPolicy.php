<?php

namespace App\Policies;

use App\Faq;
use App\Permission;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FaqPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any faqs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if ($user) {
            // Any logged in user should be able to list
            // all Faqs (controller does filtering for role)
            return true;
        }
    }

    /**
     * Determine whether the user can view the faq.
     *
     * @param  \App\User  $user
     * @param  \App\Faq  $faq
     * @return mixed
     */
    public function view(User $user, Faq $faq)
    {

        // An faq can have a minimum role_id set. If
        // so we need to test if the user has at least that
        // role
        if ($faq->role) {
            return Permission
                ::where('user_id', $user->id)
                ->where("role_id", "<=", $faq->role->id)
                ->exists();
        } else {
            return true;
        }
    }

    /**
     * Determine whether the user can create faqs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin() || $user->isChair();
    }

    /**
     * Determine whether the user can update the faq.
     *
     * @param  \App\User  $user
     * @param  \App\Faq  $faq
     * @return mixed
     */
    public function update(User $user, Faq $faq)
    {
        return $user->isAdmin() || $user->isChair();
    }

    /**
     * Determine whether the user can delete the faq.
     *
     * @param  \App\User  $user
     * @param  \App\Faq  $faq
     * @return mixed
     */
    public function delete(User $user, Faq $faq)
    {
        return $user->isAdmin() || $user->isChair();
    }
}