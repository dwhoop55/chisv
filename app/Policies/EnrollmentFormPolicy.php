<?php

namespace App\Policies;

use App\EnrollmentForm;
use App\Role;
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
        if ($user->isAdmin()) {
            return true;
        }
        // Also allow view when the enrollment form is a template (unfilled)
        // and also used by one of
        // the conferences the user can manage
        if ($enrollmentForm->is_filled == false) {
            $conferencesAssociated = $enrollmentForm->conferences;
            $conferencesAsChair = $user->conferencesByRole(Role::byName('chair'));
            foreach ($conferencesAsChair as $conference) {
                if ($conferencesAssociated->contains($conference)) {
                    return true;
                }
            }
        } else {
            // The enrollment form is not a template (filled)
            // TODO: we could add something like removing weights
            // and then allow even SVs to access. But since the
            // SVs get the cleaned enrollment form as part of the
            // permission anyway there is no need to extend
            // this section further atm
        }

        return false;
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