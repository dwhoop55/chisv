<?php

/*
 * This is the auction. It processed all bids of the SVs
 * and creates an Assignment when possible, thereby assigning
 * an SV to a task.
 * 
 * To give both sides (SVs and Chairs) a way to control the output
 * of the auction we process Task priorities (controllable by the Chairs)
 * and also bid preferences (controllable by the SV). This way
 * Chairs can ensure that a very important Task is more likely to
 * get SVs assigned than a Task with a lower priority.
 * 
 * On the other hand we respect the SVs bid preference.
 * 
 * The auction algorithm will run in two phases.
 * 1st Phase
 *  Loop through all Tasks sorted by priority descending
 *      For every task:
 *      Loop through a list of SVs which have less hours_done (<) worked
 *      than the conference suggests. This list has to be sorted by preference
 *      descending. Each block of preferences within this list has the SVs in
 *      ascending hours_done order. Only have SVs in the list which have at least bid with
 *      preference 1 (>=).
 *          For every SV in the list:
 *          If task has free slots available
 *              Assign the user to the task and mark the bid as 'successful'
 *          Otherwise
 *              Only mark the bid as unsuccessful
 * 
 * After that phase we know that all high priority tasks are more likely assigned then
 * low priority tasks. We know that SVs which have bid high on a task and are not yet
 * at the suggested hours are likely to have that task assigned. We also know that
 * we are aiming at an equal distribution of hours, since we sorted the SVs in their preference
 * by the hours they worked ascending.
 * 
 * However, there might be tasks still not assigned, even when SVs have bid for them. These SVs
 * have already worked the suggested max hours for the conference. We decided to anyhow assign
 * them to a task when they bid at least 1 (>=) to make sure to minimize tasks which have no
 * or not the required amount of SVs assgined.
 * 
 * 2nd Phase
 *  Loop through all tasks which have not all slots filled
 *      For every task:
 *      [do the same like in phase 1 but now with SVs which
 *      have more hours_done worked (>=) than the conference
 *      suggests]
 *
 * 
 * NOTE: We use the work SV and User as synonyms in here. An SV is actually nothing more than
 *       a App\User object. We use the term 'SV' for simplicity
 * 
 *       A preference block is a section in a sorted list (sorted by preference) where in this block
 *       all SVs have the same preference.
 *       E.g. consider the following list [id, preference]:
 *          [A, 3]
 *          [B, 3]
 *          [C, 2]
 *          [D, 1]
 *          [E, 1]
 *      Preference blocks are: [A,B,C], [C] and [D,E]
 * 
*/

namespace App\Jobs;

use App\Assignment;
use App\Conference;
use App\JobParameters;
use App\Role;
use App\State;
use App\Task;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class Auction extends AdvancedJob implements ExecutableJob
{
    public $conference;
    public $date;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(JobParameters $params)
    {
        parent::__construct($params);
        $this->conference = Conference::find($params->payload->conference_id);
        $this->date = new Carbon($params->payload->date);
    }

    /**
     *
     * @param Task $task The task we want to assign SVs to
     * @return Collection<Assignment> Created assignments for this task
     */
    public function processTask(Task $task, int $phase = 1, Collection $svs, State $successfulBid, State $unsuccessfulBid)
    {



        Log::debug($svs);
        return ["task" => $task, "assignments" => collect()];


        $createdAssignments = collect();

        // ======================== SV list creation ========================

        // Even when we get a list which only contains tasks
        // which have free slots, since this code might run a longer time
        // we have to ensure to check for free slots before we process
        // a task. A chair/captain might have changed assignments in the
        // UI while this code runs.
        if ($task->freeSlots() > 0) {
            // Free slots available

            // Get a list of users with the bid for this task
            $svs = $task->usersWithBid->map(function ($user) use ($task, $phase) {
                // This will go through all SVs which have bid for the task
                // We have to check for
                // (1) Preference of the bid
                // (2) Availability regarding other assignments
                // (3) hours_done the SVs worked and act based on the phase we're in

                // We can be sure that $bid exists since we are
                // looping over a list of SVs which we got by having
                // a user-bid-task relation, so there has to be a bid
                $user->bid = $user->bidFor($task);

                // (1)
                // A valid bid is any bid which a preference higher than
                // 0. 0 Indicates an 'unavailable' bid
                $user->hasValidBid = $user->bid->preference >= 1;

                // (2)
                $user->isAvailable = ($user->tasksAtTime($task)->count() == 0);

                // (3)
                // Fetch the hours the SV has worked for this conference
                $user->hours_done = $user->hoursFor($task->conference);
                $user->isOverHours = ($user->hours_done >= $task->conference->volunteer_hours);


                // When the SV has a valid bid (1) and is available (2) for
                // the task and based on the phase is/not over the suggest hours
                // then we leave him/her/x in the list
                // Thus returning the user in this transform method
                // Otherwise we return null to later remove these items
                if (
                    $user->hasValidBid && // (1)
                    $user->isAvailable && // (2)
                    (($phase == 1 && !$user->isOverHours) || ($phase == 2 && $user->isOverHours)) // (3)
                ) {
                    return $user;
                } else {
                    return null;
                }
            });

            // We marked some items for removal by setting them null
            // earlier. Now we get rid of these items.
            $svs = $svs->reject(function ($user) {
                return ($user == null);
            });
        } // For each SV (map)

        // Next is quite important to make the sorting of the preference blocks
        // more random later on. The list of SVs we now have is sorted by user id
        // from the database. When we sort by preference now we will end up with
        // asceding user ids in each preference block. This would be neglectable
        // since we will be sorting on the hours_done later on. BUT, at the
        // start of the conference all SVs have very little done_hours or none
        // at all. So this will not randomize the preference blocks at all.
        // To overcome this we shuffle the entire SV list before sorting it.
        // This way we can ensure that the preference blocks are randomized
        // even if there are not hours_done to sort by in the beginning
        $svs = $svs->shuffle();


        // We now have a list of svs which fit our filter requirements
        // We now have to sort them based on preference and hours_done

        // =========================== SORTING ===========================

        // First we sort by bid preference descending
        $svs = $svs->sort(function ($a, $b) {
            return $a->bid->preference < $b->bid->preference;
        });

        // Now lets sort each block of preferences descending by hours_done
        $sortedSvs = collect();
        // For every preference group  (1-3)
        for ($preference = 3; $preference >= 1; $preference--) {
            // Get a list with only SVs with the preference
            $svsByPreference = $svs->filter(function ($sv) use ($preference) {
                return ($preference == $sv->bid->preference);
            });

            // Sort this list by hours_done descending
            $svsByPreference = $svsByPreference->sort(function ($a, $b) {
                return $a->hours_done > $b->hours_done;
            });

            // Add the preference block to our new list
            $sortedSvs = $sortedSvs->merge($svsByPreference);
        }
        // Assign back to the original list
        $svs = $sortedSvs;

        // ============================ ASSIGNMENT ===========================

        // $svs is now a list with filtered and sorted SVs which bid
        // for the task, are available, match the hours_done and
        // are sorted to that the top most SV fits the task best

        // Now we look at every SV in the list and assign to a
        // task if there are free slots available for the task
        // Eventually we mark the bid as either successful or
        // unsuccessful
        while ($svs->isNotEmpty()) {
            // Get the first SV in the list
            $sv = $svs->shift();

            // Check if there are still slots available
            // Assign if possible, otherwise mark bid as
            // unsuccessful
            $task->refresh(); // Very important, or laravel will use cached freeSlots()
            if ($task->freeSlots() > 0) {
                // Create new Assignment and persists it to the database
                // hours are set to the hours of the task
                $assignment = $task->assign($sv);

                // Add the new Assignment to the Assignment collection
                $createdAssignments->push($assignment);

                // Mark the bid as won
                $sv->bid->state()->associate($successfulBid)->save();
            } else {
                // There are no more free slots available
                // Mark the bid as unsuccessful
                $sv->bid->state()->associate($unsuccessfulBid)->save();
            }
        }

        // Provide some additional feedback for the chair for every task
        $task->hasFreeSlots = ($task->freeSlots() > 0 ?  true : false);

        return ["task" => $task, "assignments" => $createdAssignments];
    }

    /** 
     * Get tasks which have free slots
     * @return Collection<Task> A collection of Task objects
     */
    public function getTasks()
    {
        $tasks = $this->conference->tasks()
            ->whereDate('date', $this->date)
            ->orderBy('priority', 'desc')
            ->get();

        $tasks = $tasks->filter(function ($task) {
            return ($task->freeSlots() > 0);
        });

        return $tasks;
    }

    /**
     * Execute the job.
     *
     * @return mixed The job's result
     */
    public function execute()
    {
        $this->setProgress(0);

        $svRole = Role::byName('sv');
        $successfulBid = State::byName('successful', 'App\Bid');
        $unsuccessfulBid = State::byName('unsuccessful', 'App\Bid');
        $conference = $this->conference;

        $assignments = collect();
        $tasksWithFreeSlots = collect();

        // Get a list of every SV and the bid (if any)
        // for this day
        $svs = User
            // Get SVs for this conference
            ::whereHas('permissions', function ($query) use (&$conference, &$svRole) {
                $query->where("role_id", $svRole->id);
                $query->where("conference_id", $conference->id);
            })
            // Get the bids if they are for tasks of this day's auction
            ->with([
                'bids' => function ($query) {
                    $query->select('id', 'preference', 'task_id', 'user_id');
                    $query->whereHas("task", function ($query) {
                        $query->whereDate('date', $this->date);
                    });
                },
                'bids.task:id',
            ])
            ->get('id');

        // Run this twice, phase 1 and phase 2
        for ($phase = 1; $phase <= 1; $phase++) {
            // Get all the tasks which have to be filled
            $tasks = $this->getTasks();

            $total = $tasks->count();
            $completed = 0;

            // Now for every task assign SVs
            $tasks->each(function ($task) use (&$phase, &$assignments, &$tasksWithFreeSlots, &$completed, $total, &$svs, &$successfulBid, &$unsuccessfulBid) {
                $result = $this->processTask($task, $phase, $svs, $successfulBid, $unsuccessfulBid);
                $assignments = $assignments->merge($result["assignments"]);

                // When the task has free slots and were're in phase 2
                // we mark it that it could not be filled
                if ($task->hasFreeSlots && $phase == 2) {
                    $tasksWithFreeSlots->push($task->only('id', 'name', 'start_at', 'end_at'));
                }

                // Show progress in UI
                $this->setProgress(50 / $total * $completed + (($phase - 1) * 50));
                $completed++;
            });
        }

        return [
            "created_assignments" => $assignments->count(),
            "tasks_free_slots" => $tasksWithFreeSlots
        ];
    }
}