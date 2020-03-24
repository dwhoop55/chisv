<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Bid;
use App\Conference;
use App\Http\Requests\ConferenceCreateRequest;
use App\Http\Requests\ConferenceUpdateRequest;
use App\Http\Requests\EnrollRequest;
use App\Http\Requests\NotificationPostRequest;
use App\State;
use App\User;
use App\Role;
use App\Http\Resources\Conferences;
use App\Job;
use App\Notifications\Announcement;
use App\Permission;
use App\Services\EnrollmentFormService;
use App\Task;
use Carbon\Carbon as Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ConferenceController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Conference::class);
    }

    /**
     * Show a conference.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Conference $conference)
    {
        $enrollmentFormService = new EnrollmentFormService;
        $conference->loadMissing(['icon', 'artwork', 'state', 'timezone', 'enrollmentFormTemplate']);
        if (auth()->user()->cannot('updateEnrollmentFormWeights', $conference)) {
            $conference->enrollment_form_template = $enrollmentFormService
                ->removeWeights($conference->enrollmentFormTemplate);
        }
        return $conference;
    }


    /** 
     * Post a notification to groups, users and email
     * 
     * @param App\Conference
     * @return Collection A collection with all destionations for that conference
     */
    public function postNotification(Conference $conference, NotificationPostRequest $notification)
    {
        $destinations = collect($notification->destinations);

        // First we pull in all the users
        $users = $destinations
            ->filter(function ($destination) {
                return isset($destination['type']) && $destination['type'] == 'user';
            })
            ->map(function ($user) {
                return User::find($user['user_id']);
            });

        // Then we load the groups to extract users from these
        $groups = $destinations->filter(function ($destination) {
            return isset($destination['type']) && $destination['type'] == 'group';
        });
        // And push them into the $users collection
        $groups->each(function ($group) use (&$users, $conference) {
            abort_if(!isset($group['role_id']), 500, "Group does not contain role_id!");
            $groupUsers = User
                ::whereHas('permissions', function ($query) use ($group, $conference) {
                    $query->where('role_id', $group['role_id']);
                    $query->where('conference_id', $conference->id);
                    $query->when(isset($group['state_id']), function ($query) use ($group) {
                        $query->where('state_id', $group['state_id']);
                    });
                })
                ->get();
            $users = $users->merge($groupUsers);
        });


        // Next we collect all the manually added email adresses
        $emails = $destinations->filter(function ($destination) {
            return isset($destination['type']) && $destination['type'] == 'email';
        });

        // Now we dispatch the Announcement and let it deliver via its channels
        $users = $users->unique();
        $announcement = new Announcement(
            $notification->elements,
            $conference,
            $notification->subject,
            $notification->greeting,
            $notification->salutation
        );
        Notification::send($users, $announcement);

        // Email the Announcement to the manually added addresses
        $emails->each(function ($email) use ($announcement) {
            Notification::route('mail', $email['email'])->notify($announcement);
        });

        $count = $users->count() + $emails->count();
        return [
            "result" => true,
            "message" => "$count users will be notified via the available channels (e.g. email, web notification system). You may check 'Background Jobs'."
        ];
    }

    /** 
     * Get all the possible notification destinations
     * for a conference
     * 
     * @param App\Conference
     * @return Collection A collection with all destinations for that conference
     */
    public function destinations(Conference $conference)
    {
        $groups = [
            [
                'role_id' => 10,
                'type' => 'group',
                'display' => 'All SVs'
            ],
            [
                'role_id' => 10,
                'state_id' => 12,
                'type' => 'group',
                'display' => 'Accepted SVs'
            ],
            [
                'role_id' => 10,
                'state_id' => 13,
                'type' => 'group',
                'display' => 'Waitlisted SVs'
            ],
            [
                'role_id' => 3,
                'type' => 'group',
                'display' => 'Captains'
            ],
        ];

        $users = $conference->users->unique()->map(function ($user) {
            return [
                'user_id' => $user->id,
                'type' => 'user',
                'display' => "$user->firstname $user->lastname"
            ];
        });

        return ['groups' => $groups, 'users' => $users];
    }

    /**
     * Delete all tasks of a single day
     * 
     * @return \Illuminate\Http\Response
     */
    public function deleteAllTasks(Conference $conference, $date)
    {
        if (!$date) {
            abort(400, "You need to specify a day in YYYY-MM-DD format!");
        } else if (!Carbon::create($date)) {
            abort(500, "Could not create date object");
        }

        $bidCount = Bid
            ::whereHas('task', function ($query) use ($date, $conference) {
                $query->whereDate('date', $date);
                $query->where("conference_id", $conference->id);
            })
            ->delete();

        $assignmentCount = Assignment
            ::whereHas('task', function ($query) use ($date, $conference) {
                $query->whereDate('date', $date);
                $query->where("conference_id", $conference->id);
            })
            ->delete();

        $taskCount = Task
            ::whereDate('date', $date)
            ->where("conference_id", $conference->id)
            ->delete();



        return ["result" => $taskCount, "message" => "$taskCount tasks, $bidCount bids and $assignmentCount assignments have been deleted for this day"];
    }

    /**
     * Delete all assignments of a single day
     * 
     * @return \Illuminate\Http\Response
     */
    public function deleteAllAssignments(Conference $conference, $date)
    {


        if (!$date) {
            abort(400, "You need to specify a day in YYYY-MM-DD format!");
        } else if (!Carbon::create($date)) {
            abort(500, "Could not create date object");
        }

        $bidCount = Bid
            ::whereHas('task', function ($query) use ($date, $conference) {
                $query->whereDate('date', $date);
                $query->where("conference_id", $conference->id);
            })
            ->where('state_id', "!=", State::byName('placed')->id)
            ->update(['state_id' => State::byName('placed', 'App\Bid')->id]);

        $assignmentCount = Assignment
            ::whereHas('task', function ($query) use ($date, $conference) {
                $query->whereDate('date', $date);
                $query->where("conference_id", $conference->id);
            })
            ->delete();


        return ["result" => $assignmentCount, "message" => "$assignmentCount assignments have been deleted. $bidCount bids have been reset to 'placed'"];
    }

    public function importTasks(Conference $conference)
    {
        // We only checked for canCreate App\Task on the middleware, not if
        // the specific conference is ok. Let's do this now
        abort_if(
            auth()->user()->cannot('createForConference', ['App\Task', null, $conference]),
            403,
            "You cannot create tasks for this conference"
        );

        $job = new Job([
            'handler' => 'App\Jobs\ImportTasks',
            'name' => "Task import for " . $conference->key,
            'payload' => ["conference_id" => $conference->id, "tasks" => request()->all()]
        ]);
        $job->saveAndDispatch();
        return ["result" => $job->id, "message" => "Task import for $conference->name has been queued as a new job"];
    }

    /**
     * Reset all SVs to 'enrolled' state
     * @return \Illuminate\Http\Response
     */
    public function resetEnrollmentsToEnrolled(Conference $conference)
    {

        $resetCount = Permission
            ::where('conference_id', $conference->id)
            ->where('role_id', Role::byName('sv')->id)
            ->where('state_id', '!=', State::byName('enrolled')->id)
            ->update([
                "state_id" => State::byName('enrolled')->id,
                "lottery_position" => null
            ]);

        return ["result" => $resetCount, "message" => "$resetCount SVs have been reset to state 'enrolled'"];
    }

    /**
     * Run the auction for the conference
     * @return \Illuminate\Http\Response
     */
    public function runAuction(Conference $conference, $date)
    {
        if (!$date) {
            abort(400, "You need to specify a day in YYYY-MM-DD format!");
        } else if (!Carbon::create($date)) {
            abort(500, "Could not create date object");
        }

        $date = Carbon::create($date);
        $job = new Job([
            'handler' => 'App\Jobs\Auction',
            'name' => "Auction for " . $conference->key . " " . $date->toDateString(),
            'payload' => ["conference_id" => $conference->id, "date" => $date]
        ]);
        $job->saveAndDispatch();
        return ["result" => $job->id, "message" => "Auction for $conference->name on " . $date->toDateString() . " has been queued as a new job"];
    }

    /**
     * Run the lottery for the conference
     * @return \Illuminate\Http\Response
     */
    public function runLottery(Conference $conference)
    {
        if ($conference->users(Role::byName('sv'))->get()->count() == 0) {
            abort(400, "The conference has no SVs. Lottery aborted");
        }

        $job = new Job([
            'handler' => 'App\Jobs\Lottery',
            'name' => "Lottery for " . $conference->key,
            'payload' => ["conference_id" => $conference->id]
        ]);
        $t = $job->saveAndDispatch();
        return ["result" => $job->id, "message" => "Lottery for $conference->name has been queued as a new job"];
    }

    /**
     * Show all tasks for a conference including
     * their assignments and users which match the params
     * 
     * @return \Illuminate\Http\Response All tasks for the requestes params
     */
    public function assignments(Conference $conference)
    {
        /**
         * We will fetch all tasks, bids, and assignments as one $tasks
         * collection. However, we will return an dict in the form
         * { users: <users identified by id>,
         *   tasks: <tasks with assignments and bids - no users, only id>
         *   total: <number of all tasks (without pagination)>
         * }
         * There will be many users on multiple tasks. To more efficiently
         * transfer this data to the client we will only send the reference
         * user.id in the assignments and one dict with all the users.
         * The UI will then have to represent a consistent look where a
         * user is assigned to multiple tasks
         */
        $search = request()->search_string;
        $day = request()->day;
        $user = auth()->user();
        $doneState = State::byName('done', "App\Assignment");

        $query = Task
            ::with([
                'assignments',
                'assignments.state:id,name',
                'assignments.user:id',

                // We use these assignment->task list to lookup time conflicts
                'assignments.user.assignments' => function ($query) use ($conference) {
                    $query->whereHas('task',  function ($query) use ($conference) {
                        $query->where('conference_id', $conference->id);
                    });
                },
                'assignments.user.assignments.task' => function ($query) use ($conference) {
                    $query->where('conference_id', $conference->id);
                },

                'bids:id,task_id,state_id,user_id,preference,user_created',
                'bids.state:id,name',

                // We need all the assignments in state done which are from a task of this conference
                // We use them to calculate the hours_done on a per user basis
                'usersWithAssignment.assignments' => function ($query) use ($doneState, $conference) {
                    $query->where('state_id', $doneState->id);
                    $query->whereHas('task', function ($query) use ($conference) {
                        $query->where('conference_id', $conference->id);
                    });
                },
            ])
            // Stay bond to this $conference
            ->where('tasks.conference_id', $conference->id)
            ->whereDate('tasks.date', $day)
            ->orderBy(request()->sort_by, request()->sort_order);

        if (strlen($search) > 0) {
            $query->where(function ($query) use ($search) {
                // We can search the user
                $query->whereHas('usersWithAssignment', function ($query) use ($search) {
                    $query->where('firstname', 'LIKE', '%' . $search . '%');
                    $query->orWhere('lastname', 'LIKE', '%' . $search . '%');
                });
                // We can search the task attributes
                $query->orWhere('name', 'LIKE', '%' . $search . '%');
                $query->orWhere('location', 'LIKE', '%' . $search . '%');
            });
        }

        $paginator = $query->paginate(request()->per_page, [
            'id', 'name', 'start_at', 'date',
            'end_at', 'hours', 'location',
            'description', 'slots', 'priority'
        ]);


        // First we create the users collection which holds every user of the requested
        // page and also the hours_done for the conference
        $users = collect();
        collect($paginator->items())->each(function ($task) use (&$users) {
            $task->usersWithAssignment->each(function ($user) use (&$users) {
                if (!isset($users[$user->id])) {
                    $nUser = $user->only(["firstname", "lastname"]);
                    $nUser['hours_done'] = round($user->assignments->sum('hours'), 2);
                    $users->put($user->id, $nUser);
                }
            });
        });

        // Now we build the tasks collection, which holds tasks, assignments, bids
        // and a reference to the user
        $tasks = collect($paginator->items())->map(function ($task) {
            $nTask = $task->only([
                'id', 'name', 'start_at',
                'end_at', 'hours', 'location',
                'description', 'slots', 'priority'
            ]);

            $nTask['assignments'] = $task->assignments->map(function ($assignment) use (&$task) {
                if (isset($assignment->user)) {

                    $nAssignment = $assignment->only(['id', 'hours', 'state', 'user']);

                    // Append a SVs bid if there is one
                    $bid = $task->bids->where('user_id', $assignment->user->id)->first();
                    $nAssignment['bid'] = $bid ? $bid->only('id', 'preference', 'state', 'user_created') : null;

                    // Provide the reference to the $users collection
                    $nAssignment['user'] = $assignment->user->only(['id']);

                    // Test for conflicts with other assignments
                    // Create a list of all tasks which the user with
                    // the current assignment has for this day and conference
                    $allTasks = $assignment->user->assignments->map(function ($assignment) {
                        return $assignment->task;
                    });

                    // Now remove the task this current assignment is bound to (which would
                    // otherwise always conflict with itself)
                    $otherTasks = $allTasks->where('id', "!=", $task->id);

                    $nAssignment['is_conflicting'] = $task->isConflicting($otherTasks);

                    return $nAssignment;
                } else {
                    return null; // If a user has been deleted and the assignments not removed
                    // we have to make sure to filter these assignments
                }
            });
            // Now remove nonexistent users
            $nTask['assignments'] = $nTask['assignments']->filter(function ($assignment) {
                return $assignment;
            });
            return $nTask;
        });

        return ["users" => $users, "tasks" => $tasks, "total" => $paginator->total()];
    }

    /**
     * Show all tasks for a conference
     * which match the params
     * 
     * @return \Illuminate\Http\Response All tasks for the requestes params
     */
    public function tasks(Conference $conference)
    {
        // Determine if we can show more infos based on if
        // the user is only an SV or also Chair/Captain
        $user = auth()->user();
        $showMore = $user->isAdmin() || $user->isChair($conference) || $user->isCaptain($conference);

        // If the user is no admin, chair, captain or accepted SV, reject access
        if (!$showMore && !$user->isSv($conference, State::byName('accepted'))) {
            abort(403);
        }


        $search = request()->search_string;
        $day = request()->day;
        $priorities = collect(explode(',', request()->priorities));
        $onlyOwnTasks = request()->only_own_tasks;
        $userIsAccepted = $user->isSv($conference, State::byName('accepted'));

        $query = Task
            ::with([
                'assignments',
                'assignments.state',
                'bids',
                'bids.state',
                // We need this 'users' and 'conference' for the $user->can(createForTask, $task)
                // so we eager load it and safe a few hundres queries
                'usersWithBid',
                'conference'
            ])
            // Filter for the desired priorities
            ->whereIn('tasks.priority', $priorities)
            // Stay bond to this $conference
            ->where('tasks.conference_id', $conference->id)
            ->whereDate('tasks.date', $day)
            ->orderBy(request()->sort_by, request()->sort_order);

        if ($onlyOwnTasks == "true") {
            $query->whereHas('assignments', function ($query) use (&$user) {
                $query->where('user_id', $user->id);
            });
        }

        // Only add queries when we are searching for something
        if (strlen($search) > 0) {
            $query->where(function ($query) use ($search) {
                $query->orWhere('tasks.name', 'LIKE', '%' . $search . '%');
                $query->orWhere('tasks.location', 'LIKE', '%' . $search . '%');
            });
        }


        $tasks = $query->paginate(request()->per_page);

        $tasks->transform(function ($task) use (&$showMore, &$user, &$userIsAccepted) {
            $safe = null;
            $safe = $task->only('id', 'name', 'location', 'description', 'start_at', 'end_at', 'hours');

            if ($showMore) {
                $safe["slots"] = $task->slots;
                $safe["priority"] = $task->priority;
                $safe["date"] = $task->date->toDateTimeString();
                $safe["conference_id"] = $task->conference->id;
            }

            // Find an assignment if there is one
            $assignment = $task->assignments->where('user_id', $user->id)->first();
            if ($assignment) {
                $safe['own_assignment'] = $assignment->only('id', 'hours', 'state');
            } else {
                $safe['own_assignment'] = null;
            }

            // With the last $skip argument we can skip some checks. This will dramatically
            // speed up the code, since we can do the tests in this scope here with data from memory
            // but tests in the policy class would require a database call
            $skip = collect(['stateCheck', 'assignmentsCheck']);
            $safe['can_create_bid'] = ($userIsAccepted && !$assignment && $user->can('createForTask', ['App\Bid', $task, $skip]));

            // Find the bid for the current user
            $bid = $task->bids->where('user_id', $user->id)->first();
            if ($bid) {
                $bid->task = $task; // $task has conference
                $safe['own_bid'] = [
                    'id' => $bid->id,
                    'preference' => $bid->preference,
                    'user_created' => $bid->user_created,
                    'state' => $bid->state->only(['id', 'name', 'description']),
                    'can_update' => ($userIsAccepted && !$assignment && $user->can('update', [$bid, $skip]))
                ];
            } else {
                $safe['own_bid'] = null;
            }



            return $safe;
        });

        return $tasks;
    }

    /**
     * Return an Array with all days where the conference has
     * tasks. We need this for the calendar in the GUI
     * 
     * @return Collection<Carbon>
     */
    public function taskDays(Conference $conference)
    {
        $rawTasks = DB::table('tasks')
            ->select('date', DB::raw('count(*) as total'))
            ->where('conference_id', $conference->id)
            ->groupBy('date')
            ->get();

        $tasks = collect();
        $rawTasks->each(function ($task) use (&$tasks) {
            $tasks->put(Carbon::create($task->date)->toDateString(), $task->total);
        });

        return $tasks;
    }

    /**
     * Show all users which are suited to be assigned for a specific
     * task
     * 
     * @return \Illuminate\Http\Response
     */
    public function svsForTaskAssignment(Conference $conference, Task $task)
    {
        $stateDone = State::byName('done', 'App\Assignment');
        $stateAssigned = State::byName('assigned', 'App\Assignment');
        $stateCheckedIn = State::byName('checked-in', 'App\Assignment');
        $stateAccepted = State::byName('accepted', 'App\User');
        $roleSv = Role::byName('sv');
        $search = request()->search_string;

        $query = $conference
            ->users($roleSv)
            ->where('state_id', $stateAccepted->id)
            ->with([
                // Get the bid(s) of the user for this task
                // There can only be one or no result
                'bids' => function ($query) use ($task) {
                    $query->select(['id', 'preference', 'user_id', 'task_id', 'user_created']);
                    $query->whereHas('task', function ($query) use ($task) {
                        $query->where('task_id', $task->id);
                    });
                },
                // Get only assignments which are for this conference
                'assignments' => function ($query) use ($conference) {
                    $query->select(['id', 'hours', 'user_id', 'task_id', 'state_id']);
                    $query->whereHas('task', function ($query) use ($conference) {
                        $query->where('conference_id', $conference->id);
                    });
                },
                'assignments.task:id,date,start_at,end_at'
            ]);

        if ($search != "") {
            $query = $query->where(function ($query) use ($search) {
                $query->where('firstname', 'LIKE', '%' . $search . '%');
                $query->orWhere('lastname', 'LIKE', '%' . $search . '%');
            });
        }

        $svs = $query->get(['users.id', 'firstname', 'lastname']);

        // Now we need to sort through all bids and only keep then once which
        // match the given task
        // Since we loop through all users anyway we use this chance to also
        // minimize the data model
        // We will return null so that we can later sanitize the collection
        $svs->transform(function ($sv) use ($task, $stateDone, $stateAssigned, $stateCheckedIn) {
            // Get the bid for this current task
            $bid = $sv->bids->first();
            if ($bid) {
                $bid = $bid->only('id', 'preference', 'user_created');
            } else {
                $bid = null;
            }
            $assignedTasks = $sv->assignments->map(function ($assignment) {
                return $assignment->task;
            });

            // Check preference and task conflicting
            // with other already assigned tasks
            // mark as null to later remove
            if (
                ($bid && $bid['preference'] == 0) // unavailable
                || $task->isConflicting($assignedTasks) // conflict at this time
            ) {
                return null;
            }

            $cleanUser['id'] = $sv->id;
            $cleanUser['firstname'] = $sv->firstname;
            $cleanUser['lastname'] = $sv->lastname;
            $cleanUser['bid'] = $bid;

            // Sum up all hours already done
            $hoursDone = $sv->assignments->where("state_id", $stateDone->id)->sum("hours");
            // // Sum up all the hours the SV will likely do today
            $hoursToday = $sv
                ->assignments
                ->filter(function ($assignment) use ($task, $stateAssigned, $stateCheckedIn) {
                    return $assignment->task->date == $task->date
                        && ($assignment->state_id == $stateAssigned->id
                            || $assignment->state_id == $stateCheckedIn->id);
                })
                ->sum("hours");

            $cleanUser['stats']['hours_done'] = round($hoursDone, 2);
            $cleanUser['stats']['hours_assigned_today'] = round($hoursToday, 2);


            // We calculate this later when we have sorted and trimmed the collection
            // $cleanUser['stats']['bids_placed'] = ...

            return $cleanUser;
        });

        // Remove the svs which we marked null earlier
        $svs = $svs->reject(function ($sv) {
            return !$sv;
        });

        // Now lets sort by preference desc
        // and hours ascending
        $svs = $svs->sortBy(function ($sv) {
            return [
                -$sv['bid']['preference'],
                $sv['stats']['hours_done'],
            ];
        });

        $count = $svs->count();

        // No we have a sorted collection of SVs to show
        // We will now add some information about the bids which were placed
        // during the whole conference. It's important to cut the
        // collection to a smaller list of $limit to or the process
        // will take way too long since we calculate this very time
        // intensive data for every SVs which we would cut from the
        // collection later anyways.
        $limit = 10;
        $subset = $svs->forPage(1, $limit)->values()
            ->map(function ($sv) use ($conference) {

                // Now we load the bids from the database for every of these SVs
                $bids = Bid
                    ::where('user_id', $sv['id'])
                    ->whereHas('task', function ($query) use ($conference) {
                        $query->where('conference_id', $conference->id);
                    })
                    ->get(['id', 'preference']);

                $sv['stats']['bids_placed'] = [
                    'unavailable' => $bids->where('preference', 0)->count(),
                    'low' => $bids->where('preference', 1)->count(),
                    'medium' => $bids->where('preference', 2)->count(),
                    'high' => $bids->where('preference', 3)->count()
                ];

                return $sv;
            });


        return ["total_matches" => $count, "returned_matches" => $limit, "svs" => $subset];
    }

    public function svsCount(Conference $conference)
    {
        return [
            "result" =>
            Permission
                ::where('conference_id', $conference->id)
                ->where('role_id', Role::byName('sv')->id)
                ->where('state_id', State::byName('accepted')->id)
                ->count(),
            "message" => null
        ];
    }

    /**
     * Show all users of a conference.
     * This code is super time critical. For around
     * 100 users it may take up to 3 seconds before we can
     * return the users. Anything you add here will slow it down
     * even more! This is why the data returned is very optimized
     * for the gui
     *
     * @return \Illuminate\Http\Response
     */
    public function svs(Conference $conference)
    {
        // Determine if we can show more infos based on if
        // the user is only an SV or also Chair/Captain
        $showMore =
            auth()->user()->isAdmin()
            || auth()->user()->isChair($conference)
            || auth()->user()->isCaptain($conference);
        $searchString = request()->search_string;
        $selectedStates = collect(explode(',', request()->only_states));
        $sortBy = request()->sort_by ?? 'lastname';
        $sortOrder = request()->sort_order ?? 'asc';
        $perPage = request()->per_page ?? '10';
        $roleSv = Role::byName('sv');
        $stateWaitlisted = State::byName('waitlisted');
        $stateSuccessful = State::byName('successful', 'App\Bid');
        $stateConflict = State::byName('conflict', 'App\Bid');
        $stateDone = State::byName('done', 'App\Assignment');

        // Do the actual query
        $query = Permission
            ::with([
                'user',
                'user.assignments' => function ($query) use ($conference) {
                    $query->whereHas('task', function ($query) use ($conference) {
                        $query->where('conference_id', $conference->id);
                    });
                },
                'user.assignments.state',
                'user.assignments.task',
                'user.bids' => function ($query) use ($conference) {
                    $query->select(['id', 'preference', 'user_id', 'task_id', 'state_id']);
                    $query->whereHas('task', function ($query) use ($conference) {
                        $query->where('conference_id', $conference->id);
                    });
                },
                'user.bids.task' => function ($query) use ($conference) {
                    $query->where('conference_id', $conference->id);
                },
                'user.university',
                'user.avatar',
                'user.country',
                'user.region',
                'user.city',
                'user.degree',
                'state',
                'enrollmentForm'
            ])
            // We have to join users to make it (1) searchable (2) sortable
            ->join('users', 'permissions.user_id', '=', 'users.id')
            // We have to join enrollment_forms to make it sortable
            ->leftJoin('enrollment_forms', 'permissions.enrollment_form_id', '=', 'enrollment_forms.id')
            // We have to join universities to make it searchable
            ->leftJoin('universities', 'users.university_id', '=', 'universities.id')
            // Stay bond to this $conference and 'sv' state
            ->where('conference_id', $conference->id)
            ->where("role_id", $roleSv->id)
            ->orderBy($sortBy, $sortOrder);

        // Only add queries when we are searching for something
        if (strlen($searchString) > 0) {
            $query->where(function ($query) use ($searchString) {
                $query->orWhere('users.firstname', 'LIKE', '%' . $searchString . '%');
                $query->orWhere('users.lastname', 'LIKE', '%' . $searchString . '%');
                // $query->orWhere('universities.name', 'LIKE', '%' . $searchString . '%');
                $query->orWhere('users.email', 'LIKE', '%' . $searchString . '%');
            });
        }

        // Only add state filter when in the request
        if (request()->only_states) {
            $query->whereIn("state_id", $selectedStates);
        }

        // Load the paginated results from the database
        // Only retreive 'permissions.*' or we would have collision
        // due to the joins we did earlier
        $paginated = $query->paginate($perPage, ['permissions.*']);

        // We need to design our returned user objects in a special way
        // since also SVs can sniff these from the dev tools        
        $paginated->getCollection()->transform(function ($permission) use ($showMore, $conference, $stateDone, $stateSuccessful, $stateWaitlisted, $stateConflict) {
            $safe = null;
            $user = $permission->user;
            $safe = $user->only('firstname', 'lastname', 'id');
            $safe['avatar'] = $user->avatar;
            $safe['university'] = $user->university ? $user->university->name : $user->university_fallback;
            $safe['permission'] = new Permission();
            $safe['permission']->state = new State();
            $safe['permission']->state->id = $permission->state->id;
            $safe['permission']->state->name = $permission->state->name;
            $safe['permission']->state->description = $permission->state->description;
            $safe['country'] = $user->country->name;
            $safe['region'] = $user->region->name;

            // Add statistics for chair/captain or if the user requesting
            // the data is the user which is currently processed
            if ($showMore || $user->id == auth()->user()->id) {
                $bids = $user->bids->filter(function ($bid) use (&$conference) {
                    return $bid->task->conference_id = $conference->id;
                });

                $safe['canViewBids'] = auth()->user()->can('viewBidsForConference', ['App\User', $user, $conference]);


                $hoursDone = $user->assignments->where('state_id', $stateDone->id)->sum('hours');
                $safe['stats'] = [
                    "assignments" => [
                        "count" => $user->assignments->count(),
                        "done" => $user->assignments->where('state_id', $stateDone->id)->count()
                    ],
                    "hours_done" => round($hoursDone, 2),
                    "bids_placed" => [
                        'unavailable' => $bids->where('preference', 0)->count(),
                        'low' => $bids->where('preference', 1)->count(),
                        'medium' => $bids->where('preference', 2)->count(),
                        'high' => $bids->where('preference', 3)->count()
                    ],
                    "bids_successful" => [
                        'low' => $bids->where('state_id', $stateSuccessful->id)->where('preference', 1)->count(),
                        'medium' => $bids->where('state_id', $stateSuccessful->id)->where('preference', 2)->count(),
                        'high' => $bids->where('state_id', $stateSuccessful->id)->where('preference', 3)->count()
                    ],
                    "bids_conflict" => [
                        'low' => $bids->where('state_id', $stateConflict->id)->where('preference', 1)->count(),
                        'medium' => $bids->where('state_id', $stateConflict->id)->where('preference', 2)->count(),
                        'high' => $bids->where('state_id', $stateConflict->id)->where('preference', 3)->count()
                    ]
                ];

                // Add assignments to the SVs so that Chair/Captain and SV see assigned tasks on the SV view
                $safe['assignments'] = $user->assignments->transform(function ($assignment) {
                    $safe = $assignment->only('id', 'hours', 'created_at');
                    $safe['state'] = $assignment->state->only('id', 'name', 'description');
                    $safe['task'] = $assignment->task->only(
                        'id',
                        'name',
                        'description',
                        'location',
                        'date',
                        'start_at',
                        'end_at',
                        'priority',
                        'slots',
                        'hours'
                    );
                    return $safe;
                });
            }

            if ($showMore) {
                // Show more information
                $conference = $permission->conference;
                $safe['email'] = $user->email;
                $safe['degree'] = $user->degree->name;
                $safe['city'] = $user->city ? $user->city->name : "";
                $safe['permission']->id = $permission->id;
                $safe['permission']->lottery_position = $permission->lottery_position;
                $safe['permission']->created_at = $permission->created_at;
                $safe['permission']->enrollment_form = $permission->enrollmentForm ? $permission->enrollmentForm->only(['name', 'id', 'parent_id', 'body', 'total_weight']) : null;
                $safe['permission']->conference = new Conference();
                $safe['permission']->conference->id = $conference->id;
                $safe['permission']->role = new Role();
                $safe['permission']->role->id = $permission->role->id;

                // This is the only function which slows down a call to @sv
                // when n='num of svs' grow
                if ($permission->state == $stateWaitlisted) {
                    $safe['permission']->waitlist_position = $permission->updateWaitlistPosition();
                }
            }
            return $safe;
        });

        return $paginated;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conferences = Conference
            ::with('icon', 'artwork', 'state')
            ->orderBy('start_date', 'desc')
            ->get()
            ->filter(function ($conference) {
                return auth()->user()->can('view', $conference);
            });

        return $conferences->values();
    }

    /** 
     * Returns the state of enrollment
     * 
     * @param \App\Conference conference
     * @return \Illuminate\Http\Response
     */
    public function enrollment(Conference $conference)
    {
        $permission = Permission
            ::with(['state'])
            ->where('conference_id', $conference->id)
            ->where('user_id', auth()->user()->id)
            ->where('role_id', Role::byName('sv')->id)->first();

        $enrollmentFormService = new EnrollmentFormService;

        // In any case, make sure that we remove the weights before
        // sending the form back to the user
        if ($permission) {
            if ($permission->enrollmentForm) {
                // The user is associated SV and has an enrollment form
                $form = $permission->enrollmentForm;
                $permission->enrollment_form = $enrollmentFormService->removeWeights($form);
            } else {
                // The user is associated SV but has no enrollment form
            }
            $permission->updateWaitlistPosition();
            return ["permission" => $permission];
        } else {
            // User is not associated as SV. Return the template form
            $form = $conference->enrollmentFormTemplate;
            $form = $enrollmentFormService->removeWeights($form)->only('is_template', 'body', 'id');
            return ["enrollment_form" => $form];
        }
    }

    /** 
     * Enrolls a user to be an SV for the conference
     * 
     * @param \App\Conference conference
     * @param \App\User user
     * @return \Illuminate\Http\Response
     */
    public function enroll(EnrollRequest $request, Conference $conference, User $user = null)
    {

        if (!$user) {
            // When there is no user specified the request means the
            // authUser wants to enroll self
            // So we set the user to enroll to the authUser
            $user = auth()->user();
        }

        // Now create the enrollmentForm
        $enrollmentFormService = new EnrollmentFormService();
        $enrollmentForm = $enrollmentFormService->getFilledWith($request);
        $enrollmentForm = $enrollmentFormService->removeWeights($enrollmentForm);

        if (!$enrollmentForm->save()) {
            return ["result" => null, "message" => "There was an error while creating the enrollment form"];
        }

        $permission = new Permission();
        $permission->conference()->associate($conference);
        $permission->user()->associate($user);
        $permission->state()->associate(State::byName('enrolled'));
        $permission->role()->associate(Role::byName('sv'));
        $permission->enrollmentForm()->associate($enrollmentForm);

        // Create the permission
        $permission->save();

        if (!$permission) {
            return ["result" => null, "message" => "There was an error while granting SV permissions"];
        }

        return ["result" => $permission, "message" => "You are now enrolled"];

        // $permission->enrollmentForm()->save($enrollmentForm);
        // // We painfully reload manually here because ->refresh on the
        // // model does not work..
        // // We need to reload to have the permission that we return also
        // // carry the enrollmentForm
        // $permission = Permission::find($permission->id);

    }

    /** Update all enrollmentForms of a conference with new weights
     * @param Conference conference The conference where all forms will be updated
     * @param Collection weights A key value collection where the key
     * is the fieldname and the value represents the weight
     * @return \Illuminate\Http\Response
     */
    public function updateEnrollmentFormWeights(Conference $conference, EnrollmentFormService $enrollmentFormService)
    {
        $weights = request()->toArray();
        $total = 0;
        if (!$weights) {
            // load the default weights from the default conference
            // enrollmentForm
            $weights = $enrollmentFormService->extractWeights($conference->enrollmentFormTemplate);
        }

        foreach ($conference->filledEnrollmentForms as $form) {
            $form->updateTotalWeight($weights);
            $total++;
        }

        return ["result" => true, "message" => "Updated " . $total . " enrollment forms weights"];
    }

    /** 
     * Unenrolls a user from the conference
     * 
     * @param \App\Conference conference
     * @return \Illuminate\Http\Response
     */
    public function unenroll(Conference $conference, User $user = null)
    {
        if (!$user) {
            // When there is no user specified the request means the
            // authUser wants to unenroll self
            // So we set the user to unenroll to the authUser
            $user = auth()->user();
        }

        $result = $user->revoke(Role::byName('sv'), $conference);
        return ["success" => $result, "message" => "You are now longer enrolled"];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConferenceCreateRequest $request)
    {
        $validated = $request->validated();
        $validated['start_date'] = Carbon::create('now')->toDateString();
        $validated['end_date'] = Carbon::create('now')->addDays(1)->toDateString();
        $result = Conference::create($validated);
        return ["success" => $result, "message" => "Conference created"];
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Conference  $conference
     * @return \Illuminate\Http\Response
     */
    public function update(ConferenceUpdateRequest $request, Conference $conference)
    {
        $data = $request->only(
            'name',
            'key',
            'location',
            'timezone_id',
            'start_date',
            'end_date',
            'description',
            'url_name',
            'url',
            'description',
            'enrollment_form_id',
            'state_id',
            'volunteer_hours',
            'volunteer_max',
            'email_chair',
            'bidding_enabled',
            'bidding_start',
            'bidding_end'
        );

        $result = $conference->update($data);
        $conference->refresh()->loadMissing(['icon', 'artwork', 'state']);
        return ["result" => $conference, "message" => "Conference updated"];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Conference  $conference
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conference $conference)
    {
        if ($conference->icon) $conference->icon->delete();
        if ($conference->artwork) $conference->artwork->delete();
        Permission::where('conference_id', $conference->id)->delete();
        foreach ($conference->assignments as $assignment) {
            $assignment->delete();
        }
        foreach ($conference->bids as $bid) {
            $bid->delete();
        }
        foreach ($conference->tasks as $task) {
            $task->delete();
        }
        $result = $conference->delete();
        return ["success" => $result, "message" => "Conference deleted"];
    }


    // Blade views

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showIndex()
    {
        return view('conference.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCreate()
    {
        $this->authorize('create', Conference::class);
        return view('conference.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Conference  $conference
     * @return \Illuminate\Http\Response
     */
    public function showModel(Conference $conference)
    {
        return view('conference.show', compact('conference'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Conference  $conference
     * @return \Illuminate\Http\Response
     */
    public function showEdit(Conference $conference)
    {
        $this->authorize('update', $conference);
        return view('conference.edit', compact('conference'));
    }
}