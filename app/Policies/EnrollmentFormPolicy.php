<?php

namespace App\Policies;

use App\EnrollmentForm;
use App\Role;
use App\State;
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
     * enrollment forms.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewTemplates(User $user)
    {
        // Allow view when the user is managing conferences
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
        // Also allow view when the enrollment form is a template
        // and also used by one of
        // the conferences the user can manage
        if ($enrollmentForm->is_template == true) {
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
        if ($user->can('update', $enrollmentForm->user)) {
            return true;
        } else if (
            $enrollmentForm->user->id == $user->id
            && $enrollmentForm->permission->conference->state->id == State::byName('enrollment')->id
        ) {
            // We also allow when the enrollment form belongs to the auth users permission
            // and the conference bound to that construct is still in enrollment phase
            return true;
        }
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
}