<?php

namespace App\Policies;

use App\Assignment;
use App\Note;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotePolicy
{
    use HandlesAuthorization;

    // /**
    //  * Determine whether the user can view any notes.
    //  *
    //  * @param  \App\User  $user
    //  * @return mixed
    //  */
    // public function viewAny(User $user)
    // {

    // }

    /**
     * Determine whether the user can view the note.
     *
     * @param  \App\User  $user
     * @param  \App\Note  $note
     * @return mixed
     */
    public function view(User $user, Note $note)
    {
        if (is_a($note->for, 'App\User')) {
            $conferencesOfFor = $note->for->conferences;
            $manageableConferences = $user->conferencesAsChairOrCaptain();
            $conferencesTheyShare = $conferencesOfFor->intersect($manageableConferences);
        } else if (is_a($note->for, 'App\Assignment')) {
            $conference = $note->for->task->conference;
        }


        if (
            $user->isAdmin() ||
            ($conference && $user->isChair($conference)) || // Assignment
            ($conference && $user->isCaptain($conference)) || // Assignment
            ($conferencesTheyShare && $conferencesTheyShare->isNotEmpty()) // User
        ) {
            return true;
        }
    }

    /**
     * Determine whether the user can create notes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $this->view();
    }

    /**
     * Determine whether the user can update the note.
     *
     * @param  \App\User  $user
     * @param  \App\Note  $note
     * @return mixed
     */
    public function update(User $user, Note $note)
    {
        return $this->view();
    }

    /**
     * Determine whether the user can delete the note.
     *
     * @param  \App\User  $user
     * @param  \App\Note  $note
     * @return mixed
     */
    public function delete(User $user, Note $note)
    {
        return $this->view();
    }

    // /**
    //  * Determine whether the user can restore the note.
    //  *
    //  * @param  \App\User  $user
    //  * @param  \App\Note  $note
    //  * @return mixed
    //  */
    // public function restore(User $user, Note $note)
    // {
    //     //
    // }

    /**
     * Determine whether the user can permanently delete the note.
     *
     * @param  \App\User  $user
     * @param  \App\Note  $note
     * @return mixed
     */
    public function forceDelete(User $user, Note $note)
    {
        //
    }
}