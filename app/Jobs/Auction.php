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
 * Before we run the auction we need to make sure that every SV
 * has one bid for every task. We will create a low preference bid
 * if an SV has no bid for a task. We do this before we run any actual
 * auction algorithm.
 * 
 * The actual auction algorithm will run in two phases.
 * 1st Phase
 *  Loop through all Tasks sorted by priority descending
 *      For every task:
 *      Loop through a list of SVs which have less hours_done (<) worked
 *      than the conference suggests. This list has to be sorted by preference
 *      descending. Each block of preferences within this list has the SVs in
 *      ascending hours_done order. Only have SVs in the list which have at least bid with
 *      preference 1 (>=). This includes the implicit 'no bid' which is assumed to count
 *      like a bid placed with preference 1.
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
use App\Bid;
use App\Conference;
use App\JobParameters;
use App\Role;
use App\State;
use App\Task;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
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
     * @return Collection Assignments and bids to create/mark for this task
     */
    public function processTask(Task $task, int $phase = 1)
    {
        $assignmentsToCreate = collect();
        $bidsToUpdate = collect();

        // ======================== SV list creation ========================
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
                // so we cannot limit it to the auction's date
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


        // Let's transform the huge collection we now have
        // to something we can more easily work with
        $svs->transform(function ($sv) use (&$task, $phase) {
            $new = ["id" => $sv->id];
            // Grab the preference for the current task if there is one
            // If there is none, we set it to 1 since SVs are being told
            // if they don't bid it counts like a bid with preference 1
            // Also, this is what the UI shows when there is no bid 
            if ($sv->bids->isNotEmpty()) {
                $new['preference'] = $sv->bids->first()->preference;
                $new['bid_id'] = $sv->bids->first()->id;
            } else {
                $new['preference'] = 1;
            }

            // Now we sum up the hours the SV has worked already
            // so the assignments which are in the state 'done'
            $new['hours_done'] = round($sv->assignments
                ->where("state_id", $this->doneState->id)
                ->sum('hours'), 2);
            // Next we need to add the hours the SV will be doing
            // at the auction's date. This way we only assign
            // up to the suggested working hours limit
            // NOTE: This will not account for assignments which are on
            // another day in state other than done
            // These would first have to be marked 'done' to get caught
            // in the sum above
            $new['hours_done'] += round($sv->assignments->filter(function ($assignment) {
                return $assignment->task->date == $this->date;
            })->sum('hours'), 2);

            // Now we check for a task conflict
            // Get all the tasks which are today
            // (and of this conference -> see DB call above)
            // NOTE: This does assume the SV is working at only one
            // conference at a time. There is no conflict avoidance
            // for tasks at the same time but different conferences!
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

        // Now we have to remove some SVs from the list
        // which are unavailable, have worked too much,
        // (depends on the phase we are in)
        // or are in conflict with another task
        $svs = $svs->reject(function ($sv) use (&$phase, &$bidsToUpdate) {
            if ($phase == 1 && $sv['hours_done'] >= $this->conference->volunteer_hours) {
                $reject = true;
            } else if ($sv['preference'] === 0) {
                $reject = true;
                // we mark the bid as an unavailable bid
                if (isset($sv['bid_id'])) {
                    $bidsToUpdate->push(['id' => $sv['bid_id'], 'state_id' => $this->unavailableState->id]);
                }
            } else if ($sv['hasConflict'] === true) {
                $reject = true;
                // we mark the bid (if there is one) as unsuccessfull
                if (isset($sv['bid_id'])) {
                    $bidsToUpdate->push(['id' => $sv['bid_id'], 'state_id' => $this->conflictState->id]);
                }
            } else {
                // SV matches criteria, do not reject
                $reject = false;
            }
            return $reject;
        })->values();

        // We now have a list with possible SVs which are still unsorted
        // We will now first shuffle the SVs to make the sorting more
        // random in the preference groups when SVs have the same
        // hours_done (more likely at the beginning of the conference)
        // when they all have 0. Without this shuffling we would
        // assign SVs based on user id, lower first. So whoever signed
        // up first would get the task. That is not desired, so we
        // shuffle first.

        $svs = $svs->shuffle();


        // We now have a list of svs which fit our filter requirements
        // We now have to sort them based on preference and hours_done

        // =========================== SORTING ===========================

        // First we sort by bid preference descending
        $svs = $svs->sort(function ($a, $b) {
            return $a['preference'] < $b['preference'];
        });

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

        // ============================ ASSIGNMENT ===========================

        // $svs is now a list with filtered and sorted SVs which bid
        // for the task higher (>=2) or have implicitly bid 1 by not bidding at all
        // They are available, match the hours_done and
        // are sorted to that the top most SV fits the task best

        // Get a collection of SVs which will be assigned based on free slots
        // and a collection of SVs which have bid but did not get a slot,
        // since all slots are gone
        $svsToAssignToTask = $svs->take($task->freeSlots());

        // Build an array holding the assignments which
        // need to be created for this task
        // Build an array holding the bids which need
        // to be marked as won
        $svsToAssignToTask->each(function ($sv) use ($task, &$assignmentsToCreate, &$bidsToUpdate) {
            $assignmentsToCreate->push([
                'user_id' => $sv['id'],
                'task_id' => $task->id,
                'hours' => $task->hours,
            ]);

            if (isset($sv['bid_id'])) {
                $bidsToUpdate->push(['id' => $sv['bid_id'], 'state_id' => $this->successfulState->id]);
            }
        });

        return ['assignmentsToCreate' => $assignmentsToCreate, 'bidsToUpdate' => $bidsToUpdate];
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
            ->get(['id', 'slots', 'name', 'hours', 'date', 'start_at', 'end_at']);

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
        $this->svRole = Role::byName('sv');
        $this->successfulState = State::byName('successful', 'App\Bid');
        $this->unsuccessfulState = State::byName('unsuccessful', 'App\Bid');
        $this->conflictState = State::byName('conflict', 'App\Bid');
        $this->unavailableState = State::byName('unavailable', 'App\Bid');
        $this->doneState = State::byName('done', 'App\Assignment');

        $createdAssignments = 0;
        $tasksWithFreeSlots = collect();

        // // ============================ BID PREPARATION ===========================
        // // First we prepare the bids so that every SV has one bid for every task
        // $this->setStatusMessage("Preparing bids..");
        // $svs = User
        //     // Only SVs for this conference
        //     ::whereHas('permissions', function ($query) {
        //         $query->where("role_id", $this->svRole->id);
        //         $query->where("conference_id", $this->conference->id);
        //     })
        //     // With bids for this conference (task) and date 
        //     ->with([
        //         'bids' => function ($query) use (&$task) {
        //             $query->select('id', 'user_id', 'task_id');
        //             $query->whereHas('task',  function ($query) {
        //                 $query->select('id');
        //                 $query->where('conference_id', $this->conference->id);
        //                 $query->whereDate('date', $this->date);
        //             });
        //         },
        //         'bids.task:id'
        //     ])
        //     ->get(['id']);

        // // Now get a list of all tasks of this date and conference
        // $tasks = Task
        //     ::whereDate('date', $this->date)
        //     ->where('conference_id', $this->conference->id)
        //     ->get('id');

        // // Setup some counters for status messages
        // $svsCount = $svs->count();
        // $svsChecked = 0;

        // // Now we check every SV if there are bids missing
        // $svs->each(function ($sv) use (&$tasks, &$svsCount, &$svsChecked) {
        //     // Get a collection of all tasks a user had bid for
        //     $tasksSvHasBidsFor = $sv->bids->map->task_id;
        //     // Now remove all the tasks which the user has bid for already
        //     $tasksWhichNeedBid = $tasks->reject(function (&$task) use (&$tasksSvHasBidsFor) {
        //         // When the SV has a bid for a task, the task's id is in tasksSvHasBidsFor
        //         // If the current tested task's id is in that collection
        //         // we can remove it from the list which need new bids to be created
        //         return $tasksSvHasBidsFor->contains($task->id);
        //     })->values();

        //     // If there are tasks which have no bid yet we procceed..
        //     if ($tasksWhichNeedBid->isNotEmpty()) {
        //         $this->setStatusMessage("[Saving] Creating " . $tasksWhichNeedBid->count() . " bids for sv id=$sv->id \ncompleted=" . $svsChecked . "/$svsCount");

        //         // Create an array for mass database insert
        //         $bidsToCreate = $tasksWhichNeedBid->map(function ($task) use ($sv) {
        //             return [
        //                 'user_id' => $sv->id,
        //                 'task_id' => $task->id,
        //                 'preference' => 1
        //             ];
        //         });
        //         // Create all the missing bids at once
        //         DB::table('bids')->insert($bidsToCreate->toArray());
        //     }
        // });
        // unset($svs);
        // // Now every SV has one bid for every task

        // ============================ PHASES START ===========================
        // Run this twice, phase 1 and phase 2
        for ($phase = 1; $phase <= 2; $phase++) {
            // Get all the tasks which have to be filled
            $tasks = $this->getTasks();
            // Setup counters and collections
            // holding the results of all calculations
            // We use them to later create/mark the
            // actual assignments/bids
            $total = $tasks->count();
            $completed = 0;

            // Now for every task calculate the assignments/bids
            $tasks->each(function ($task) use (
                &$phase,
                &$tasksWithFreeSlots,
                &$completed,
                &$total,
                &$createdAssignments
            ) {

                $result = $this->processTask($task, $phase);
                $assignmentsToCreate = $result['assignmentsToCreate'];
                $bidsToUpdate = $result['bidsToUpdate'];

                DB::table('assignments')->insert($assignmentsToCreate->toArray());
                $bidsToUpdate->each(function ($bid) {
                    Bid
                        ::where('id', $bid['id'])
                        ->update(['state_id' => $bid['state_id']]);
                });

                // Update the counter for all toal created assignments
                $createdAssignments += $assignmentsToCreate->count();

                // When the task has free slots and were're in phase 2
                // we mark it that it could not be filled
                if ($task->fresh()->freeSlots() > 0 && $phase == 2) {
                    $tasksWithFreeSlots->push($task->only('id', 'name', 'start_at', 'end_at'));
                }

                // Show progress in UI
                $progress = 50 / $total * ++$completed + (($phase - 1) * 50);
                $bidsWonCount = $bidsToUpdate->where('state_id', $this->successfulState->id)->count();
                $bidsConflictCount = $bidsToUpdate->where('state_id', $this->conflictState->id)->count();
                $this->setStatusMessage(
                    ("New assignments by auction = " . $createdAssignments
                        . "\nThis task $completed/$total (phase $phase/2):"
                        . "\n   New assignments = " . $assignmentsToCreate->count() . "/$task->slots (slots)"
                        . "\n   New assignments with SV 'no bid' = " . ($assignmentsToCreate->count() - $bidsWonCount)
                        . "\n   Bids won = " . $bidsWonCount
                        . "\n   Bids conflicting = " . $bidsConflictCount),
                    $progress
                );
            }); // For each task
            // End of phase
        } // For phase 1,2

        // After all assignments we mark those bids as lost where they are still
        // in state 'placed' and same day as this auction
        Bid
            ::whereHas('task', function ($query) {
                $query->whereDate('date', $this->date);
                $query->where("conference_id", $this->conference->id);
            })
            ->where('state_id', State::byName('placed')->id)
            ->update(['state_id' => $this->unsuccessfulState->id]);



        $this->setStatusMessage("Done");
        return [
            "created_assignments" => $createdAssignments,
            "tasks_free_slots" => $tasksWithFreeSlots
        ];
    }
}