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
    public function processTask(Task $task, int $phase = 1)
    {
        $createdAssignments = collect();
        $startTime = Carbon::create('now');

        // Log::info("Processing auction, task " . $task->id);

        // ======================== SV list creation ========================

        // Even when we get a list which only contains tasks
        // which have free slots, since this code might run a longer time
        // we have to ensure to check for free slots before we process
        // a task. A chair/captain might have changed assignments in the
        // UI while this code runs.
        if ($task->freeSlots() > 0 && $task->id) {
            // Free slots available

            // Get a list of every SV and the bid (if any)
            // for this day
            $svs = User
                // Get SVs for this conference
                ::whereHas('permissions', function ($query) {
                    $query->where("role_id", $this->svRole->id);
                    $query->where("conference_id", $this->conference->id);
                })
                // Get the bids if they are for this task
                ->with([
                    'bids' => function ($query) use (&$task) {
                        // Laravel needs user_id for joining
                        $query->select('id', 'preference', 'user_id');
                        $query->where('task_id', $task->id);
                    },
                    // Get all assignments of
                    // the user if these are from
                    // the conference we run this
                    // auction for
                    // We calculate the hours_done from it
                    'assignments' => function ($query) {
                        // Laravel needs task and user ids for joining
                        $query->select('id', 'state_id', 'hours', 'task_id', 'user_id');
                        $query->whereHas('task',  function ($query) {
                            $query->where('conference_id', $this->conference->id);
                        });
                    },
                    'assignments.task:id,date,start_at,end_at'
                ])
                ->get('id');

            // Log::info(Carbon::create('now')->diffInMilliseconds($startTime), [2]);

            // Let's transform the huge collection we now have
            // to something we can more easily work with
            $svs->transform(function ($sv) use (&$task, &$startTime) {
                $new = ["user" => $sv];
                // Grab the preference for the current task if there is one
                // If there is none, we set it to 1 since SVs are being told
                // if they don't bid it counts like a bid with preference 1
                // Also, this is what the UI shows when there is no bid 
                if ($sv->bids->isNotEmpty()) {
                    $new['preference'] = $sv->bids->first()->preference;
                    $new['bid'] = $sv->bids->first();
                } else {
                    $new['preference'] = 1;
                }

                // Now we sum up the hours the SV has worked
                // TODO: it might make sense to also count
                // assignments which have just been created 
                // by this auction in a different run. In
                // that case we would count freshly assigned
                // tasks as 'very likely' to be completed. This
                // would distibute the hours even more.
                // This enhancement is currently not active.
                $new['hours_done'] = round($sv->assignments
                    ->where("state_id", $this->doneState->id)
                    ->sum('hours'), 2);

                $assignedTasks = $sv->assignments
                    ->filter(function ($assignment) use (&$task) {
                        return ($assignment->task->date == $task->date);
                    })
                    ->map(function ($assignment) {
                        return $assignment->task;
                    });

                $new['hasConflict'] = $task->isConflicting($assignedTasks);

                return $new;
            });
            // Log::info(Carbon::create('now')->diffInMilliseconds($startTime), [3]);

            // Now we have to remove some SVs from the list
            // which are unavailable, have worked too much,
            // (depends on the phase we are in)
            // or are in conflict with an other task
            $svs = $svs->reject(function ($sv) use (&$phase) {
                if ($phase == 1 && $sv['hours_done'] >= $this->conference->volunteer_hours) {
                    return true;
                } else if ($sv['preference'] === 0) {
                    return true;
                } else if ($sv['hasConflict'] === true) {
                    return true;
                } else {
                    // SV matches criteria, do not reject
                    return false;
                }
            })->values();
            // Log::info(Carbon::create('now')->diffInMilliseconds($startTime), [4]);

            // We now have a list with possible SVs which are still unsorted
            // We will now first shuffle the SVs to make the sorting more
            // random in the preference groups when SVs have the same
            // hours_done (more likely at the beginning of the conference)
            // when they all have 0. Without this shuffling we would
            // assign SVs based on user id, lower first. So whoever signed
            // up first would get the task. That is not desired, so we
            // shuffle first.

            $svs = $svs->shuffle();
            // Log::info(Carbon::create('now')->diffInMilliseconds($startTime), [5]);


            // We now have a list of svs which fit our filter requirements
            // We now have to sort them based on preference and hours_done

            // =========================== SORTING ===========================

            // First we sort by bid preference descending
            $svs = $svs->sort(function ($a, $b) {
                return $a['preference'] < $b['preference'];
            });
            // Log::info(Carbon::create('now')->diffInMilliseconds($startTime), [6]);

            // Now lets sort each block of preferences descending by hours_done
            $sortedSvs = collect();
            // For every preference group  (1-3)
            for ($preference = 3; $preference >= 1; $preference--) {
                // Get a list with only SVs with the preference
                $svsByPreference = $svs->filter(function ($sv) use ($preference) {
                    return ($preference == $sv['preference']);
                });

                // Sort this list by hours_done descending
                $svsByPreference = $svsByPreference->sort(function ($a, $b) {
                    return $a['hours_done'] > $b['hours_done'];
                });

                // Add the preference block to our new list
                $sortedSvs = $sortedSvs->merge($svsByPreference);
            }
            // Assign back to the original list
            $svs = $sortedSvs;
            // Log::info(Carbon::create('now')->diffInMilliseconds($startTime), [7]);

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
                    $assignment = $task->assign($sv['user']);

                    // Add the new Assignment to the Assignment collection
                    $createdAssignments->push($assignment->only('id'));

                    //If the user had bid we now mark it won
                    if (isset($sv['bid'])) {
                        $sv['bid']->state()->associate($this->successfulState)->save();
                    }
                } else {
                    // There are no more free slots available
                    // Mark the bid as unsuccessful if there is one
                    if (isset($sv['bid'])) {
                        $sv['bid']->state()->associate($this->unsuccessfulState)->save();
                    }
                }
            }
            // Log::info(Carbon::create('now')->diffInMilliseconds($startTime), [8]);
        } // if has free slots

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

        $this->svRole = Role::byName('sv');
        $this->successfulState = State::byName('successful', 'App\Bid');
        $this->unsuccessfulState = State::byName('unsuccessful', 'App\Bid');
        $this->doneState = State::byName('done', 'App\Assignment');

        $createdAssignments = 0;
        $tasksWithFreeSlots = collect();

        // Run this twice, phase 1 and phase 2
        for ($phase = 1; $phase <= 2; $phase++) {
            // Get all the tasks which have to be filled
            $tasks = $this->getTasks();

            $total = $tasks->count();
            $completed = 0;

            // Now for every task assign SVs
            $tasks->each(function ($task) use (&$phase, &$createdAssignments, &$tasksWithFreeSlots, &$completed, $total) {
                $result = $this->processTask($task, $phase);
                $createdAssignments += $result["assignments"]->count();

                // When the task has free slots and were're in phase 2
                // we mark it that it could not be filled
                if ($task->freeSlots() > 0 && $phase == 2) {
                    $tasksWithFreeSlots->push($task->only('id', 'name', 'start_at', 'end_at'));
                }

                // Show progress in UI
                $this->setProgress(50 / $total * $completed + (($phase - 1) * 50));
                $completed++;
            });
        }

        return [
            "created_assignments" => $createdAssignments,
            "tasks_free_slots" => $tasksWithFreeSlots
        ];
    }
}