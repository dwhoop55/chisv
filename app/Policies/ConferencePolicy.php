<?php

namespace App\Policies;

use App\User;
use App\Conference;
use App\State;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConferencePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can
     * list all destinations a conference
     * provides
     *
     * @param  \App\User  $user
     * @param  \App\Conference  $conference
     * @return mixed
     */
    public function viewDestinations(User $user, Conference $conference)
    {
        if ($user->isAdmin()) {
            return true;
        }

        if (
            ($user->isChair($conference) || $user->isCaptain($conference))
        ) {
            return true;
        }
    }

    /**
     * Determine whether the user can notify SVs
     *
     * @param  \App\User  $user
     * @param  \App\Conference  $conference
     * @return mixed
     */
    public function postNotification(User $user, Conference $conference)
    {
        if ($user->isAdmin()) {
            return true;
        }

        if (
            ($user->isChair($conference) || $user->isCaptain($conference))
        ) {
            // Chairs and captains can notify SVs
            return true;
        }
    }

    /**
     * Determine whether the user can view the reports.
     *
     * @param  \App\User  $user
     * @param  \App\Conference  $conference
     * @return mixed
     */
    public function viewReports(User $user, Conference $conference)
    {
        if ($user->isAdmin()) {
            // An admin can always see all reports
            return true;
        }

        if (
            ($user->isChair($conference) || $user->isCaptain($conference))
        ) {
            // Chairs and captains can see reports
            return true;
        }
    }

    /**
     * Determine whether the user can see SVs
     * 
     * @param  \App\User  $user
     * @param  \App\Conference  $conference
     * @return boolean
     */
    public function viewUsers(User $user, Conference $conference)
    {
        if ($user->isAdmin()) {
            return true;
        }

        // Only allow users associated with a conference
        if ($user->isChair($conference) || $user->isCaptain($conference) || $user->isSv($conference, State::byName('accepted'))) {
            return true;
        }

        return false;
    }

    /** 
     * Determine whether the user can list
     * SVs which are suited for a task
     * 
     * @param  \App\User  $user
     * @param  \App\Conference  $conference
     * @return boolean
     */
    public function viewUsersForTaskAssignment(User $user, Conference $conference)
    {
        if ($user->isAdmin() || $user->isChair($conference) || $user->isCaptain($conference)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can change/update 
     * a state of an enrolled user
     * 
     * @param  \App\User  $user
     * @param  \App\Conference  $conference
     * @return boolean
     */
    public function updateEnrollment(User $user, Conference $conference)
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isChair($conference)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view 
     * task assignments
     * 
     * @param  \App\User  $user
     * @param  \App\Conference  $conference
     * @return boolean
     */
    public function viewAssignments(User $user, Conference $conference)
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isChair($conference) || $user->isCaptain($conference)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can change/update 
     * task assignments
     * 
     * @param  \App\User  $user
     * @param  \App\Conference  $conference
     * @return boolean
     */
    public function updateAssignments(User $user, Conference $conference)
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isChair($conference) || $user->isCaptain($conference)) {
            return true;
        }

        return false;
    }

    public function updateEnrollmentFormWeights(User $user, Conference $conference)
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isChair($conference)) {
            return true;
        }

        return false;
    }

    public function runAuction(User $user, Conference $conference)
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isChair($conference)) {
            return true;
        }

        return false;
    }

    public function runLottery(User $user, Conference $conference)
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isChair($conference)) {
            return true;
        }

        return false;
    }

    public function deleteAssignment(User $user, Conference $conference)
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isChair($conference)) {
            return true;
        }

        return false;
    }

    public function deleteTask(User $user, Conference $conference)
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isChair($conference)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can enroll in the conferences.
     *
     * @param  \App\User  $user
     * @param  \App\Conference  $conference
     * @return mixed
     */
    public function enroll(User $authUser, Conference $conference, User $user = null)
    {
        if (!$user) {
            // When there is no user specified the request means the
            // authUser wants to enroll self
            // So we set the user to enroll to the authUser
            $user = $authUser;
        }

        if ($authUser->isAdmin() || $authUser->isChair($conference)) {
            // Allow Admins and Chairs to always enroll self or other people to the conference
            return true;
        }

        if ($user->isSv($conference)) {
            // A user can only enroll once for a conference
            // We reject because the user is already SV for conference
            return false;
        }

        if (
            $user->id == $authUser->id && // Assign permissions to self
            $conference->state == State::byName('enrollment')
        ) {
            // If the user accessing the route is also the user to enroll
            // then grant access if the conference is in state enrollment
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can unenroll from the conferences.
     *
     * @param  \App\User  $user
     * @param  \App\Conference  $conference
     * @return mixed
     */
    public function unenroll(User $authUser, Conference $conference, User $user = null)
    {
        if (!$user) {
            // When there is no user specified the request means the
            // authUser wants to unenroll self
            // So we set the user to unenroll to the authUser
            $user = $authUser;
        }

        if ($authUser->isAdmin() || $authUser->isChair($conference)) {
            // Allow Admins and Chairs to always unenroll self or other people to the conference
            return true;
        }

        if (
            $user->isSv($conference)
            && ($user->svStateFor($conference) == State::byName('enrolled')
                || $user->svStateFor($conference) == State::byName('accepted')
                || $user->svStateFor($conference) == State::byName('waitlisted'))
            && ($conference->state != State::byName('over'))
        ) {
            // A user can only unenroll when enrolled, accepted or waitlisted
            // but only if the conference is not over yet
            return true;
        } else {
            return false;
        }

        return false;
    }

    /**
     * Determine whether the user can list all conferences.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        // Everyone logged in should be able to list conferences
        return $user ? true : false;
    }

    /**
     * Determine whether the user can view the conference.
     *
     * @param  \App\User  $user
     * @param  \App\Conference  $conference
     * @return mixed
     */
    public function view(User $user, Conference $conference)
    {
        if ($conference->state == State::byName('planning')) {
            // Conference is in planning phase,
            // only admins and the associated chair
            // is allowed to access
            return ($user->isAdmin() || $user->isChair($conference));
        } else {
            // Otherwise, everyone logged in is allowed
            return $user ? true : false;
        }
    }

    /**
     * Determine whether the user can create conferences.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the conference.
     *
     * @param  \App\User  $user
     * @param  \App\Conference  $conference
     * @return mixed
     */
    public function update(User $user, Conference $conference)
    {
        return $user->isAdmin() || $user->isChair($conference);
    }

    /**
     * Determine whether the user can delete the conference.
     *
     * @param  \App\User  $user
     * @param  \App\Conference  $conference
     * @return mixed
     */
    public function delete(User $user, Conference $conference)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the conference.
     *
     * @param  \App\User  $user
     * @param  \App\Conference  $conference
     * @return mixed
     */
    public function restore(User $user, Conference $conference)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the conference.
     *
     * @param  \App\User  $user
     * @param  \App\Conference  $conference
     * @return mixed
     */
    public function forceDelete(User $user, Conference $conference)
    {
        return $user->isAdmin();
    }
}