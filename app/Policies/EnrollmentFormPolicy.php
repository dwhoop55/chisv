<?php

namespace App\Policies;

use App\EnrollmentForm;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EnrollmentFormPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any enrollment forms.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view any template
     * (unfilled) enrollment forms.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewTemplates(User $user)
    {
        // Allo view when the user is managing conferences
        if ($user->isAdmin() || $user->isChair() || $user->isCaptain()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can view the enrollment form.
     *
     * @param  \App\User  $user
     * @param  \App\EnrollmentForm  $enrollmentForm
     * @return mixed
     */
    public function view(User $user, EnrollmentForm $enrollmentForm)
    {
        //
    }

    /**
     * Determine whether the user can create enrollment forms.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the enrollment form.
     *
     * @param  \App\User  $user
     * @param  \App\EnrollmentForm  $enrollmentForm
     * @return mixed
     */
    public function update(User $user, EnrollmentForm $enrollmentForm)
    {
        //
    }

    /**
     * Determine whether the user can delete the enrollment form.
     *
     * @param  \App\User  $user
     * @param  \App\EnrollmentForm  $enrollmentForm
     * @return mixed
     */
    public function delete(User $user, EnrollmentForm $enrollmentForm)
    {
        //
    }

    /**
     * Determine whether the user can restore the enrollment form.
     *
     * @param  \App\User  $user
     * @param  \App\EnrollmentForm  $enrollmentForm
     * @return mixed
     */
    public function restore(User $user, EnrollmentForm $enrollmentForm)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the enrollment form.
     *
     * @param  \App\User  $user
     * @param  \App\EnrollmentForm  $enrollmentForm
     * @return mixed
     */
    public function forceDelete(User $user, EnrollmentForm $enrollmentForm)
    {
        //
    }
}