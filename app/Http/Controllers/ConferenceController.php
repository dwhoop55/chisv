<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Bid;
use App\Conference;
use App\EnrollmentForm;
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
     * Return Users in requested state
     * changed requested minutes ago
     *
     * @param App\Conference The conference to look at
     * @param \App\State $state State the sv has to be in
     * @param int $minutes look back that many minutes
     * @return \App\User
     */
    public function svsInStateForMinutes(Conference $conference, State $state, int $minutes)
    {

        $filter = function ($query) use ($conference, $state, $minutes) {
            $query->where('conference_id', $conference->id);
            $query->where('role_id', Role::byName('sv')->id);
            $query->where('state_id', $state->id);
            $query->whereDate('updated_at', '>=', Carbon::now()->sub($minutes, 'minutes'));
            $query->whereTime('updated_at', '>=', Carbon::now()->sub($minutes, 'minutes'));
        };

        $svs = User
            ::whereHas('permissions', $filter)
            ->with([
                'permissions' => $filter
            ])
            ->get();

        return $svs;
    }

    /**
     * @authenticated
     * @group Conference
     * Get a conference by key
     * 
     * @urlParam conference required The conference to get by key Example: chi20
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Conference $conference)
    {
        $user = auth()->user();
        $enrollmentFormService = new EnrollmentFormService;
        $conference->loadMissing([
            'icon:id,owner_id,web_path',
            'artwork:id,owner_id,web_path',
            'state:name,description',
            'timezone',
            'enrollmentFormTemplate:id,name,body'
        ]);

        // Remove weights if the user is just normal sv
        if ($user->cannot('updateEnrollmentFormWeights', $conference)) {
            $conference->enrollment_form_template = $enrollmentFormService
                ->removeWeights($conference->enrollmentFormTemplate);
        }

        return $conference;
    }


    /** 
     * @authenticated
     * @group Conference
     * Create a notification for users of a conference
     * 
     * @urlParam conference required The conference to get by key Example: chi20
     * @bodyParam destinations array required Multiple destinations, see below for 3 examples
     * @bodyParam destinations[0].type string required One of 'user', 'group' or 'email' Example:user
     * @bodyParam destinations[1].type string required One of 'user', 'group' or 'email' Example:group
     * @bodyParam destinations[2].type string required One of 'user', 'group' or 'email' Example:email
     * @bodyParam destinations[0].user_id int Is required if type is 'user' pointing to the user by id Example:1
     * @bodyParam destinations[1].role_id int Is required if type is 'group' pointing to the role by id Example: 10
     * @bodyParam destinations[1].state_id int Used if type is 'group' pointing to the state by id Example: 12
     * @bodyParam destinations[2].email string Used if type is 'email' and is the (external) user's email Example: test@example.com
     * @bodyParam elements array required Multiple elements, see below for action and markdown below
     * @bodyParam elements[0].type required One of 'action', 'markdown' Example: action
     * @bodyParam elements[1].type required One of 'action', 'markdown' Example: markdown
     * @bodyParam elements[0].data.caption string Is required if type is 'action' Example: CHISV Website
     * @bodyParam elements[0].data.url string Is required if type is 'action' Example: https://chisv.org
     * @bodyParam elements[1].data string Is required if type is 'markdown' Example: !See text below
     * @bodyParam subject string Example: Announcement
     * @bodyParam greeting string Example: Hi!
     * @bodyParam salutation string Example: Cheers
     * 
     * @param App\Conference
     * @return Collection A collection with all destinations for that conference
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
     * @authenticated
     * @group Conference
     * Get all the possible notification destinations for a conference
     * 
     * @urlParam conference required The conference to get by key Example: chi20
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
     * @authenticated
     * @group Conference
     * Delete all tasks for specified days
     * 
     * @urlParam conference required The conference's key Example: chi20
     * @queryParam days required Array of strings of all days in JSON Example: ["2020-12-25","2020-12-26"]
     * 
     * @return \Illuminate\Http\Response
     */
    public function deleteAllTasks(Conference $conference)
    {

        $days = json_decode(request()->days);

        abort_unless($days, 400, "Invalid days parameter. Requires JSON array");
        abort_if(count($days) == 0, 400, "Invalid days array. Cannot be empty");

        $bidCount = Bid
            ::whereHas('task', function ($query) use ($days, $conference) {
                $query->where("conference_id", $conference->id);
                $query->where(function ($query) use ($days) {
                    foreach ($days as $day) {
                        $query->orWhereDate('date', $day);
                    }
                });
            })
            ->delete();

        $assignmentCount = Assignment
            ::whereHas('task', function ($query) use ($days, $conference) {
                $query->where("conference_id", $conference->id);
                $query->where(function ($query) use ($days) {
                    foreach ($days as $day) {
                        $query->orWhereDate('date', $day);
                    }
                });
            })
            ->delete();

        $taskCount = Task
            ::where("conference_id", $conference->id)
            ->where(function ($query) use ($days) {
                foreach ($days as $day) {
                    $query->orWhereDate('date', $day);
                }
            })
            ->delete();



        return ["result" => $taskCount, "message" => "$taskCount tasks, $bidCount bids and $assignmentCount assignments have been deleted"];
    }

    /** 
     * @authenticated
     * @group Conference
     * Delete all assignments for the specified day
     * 
     * @urlParam conference required The conference's key Example: chi20
     * @urlParam date required Date in YYYY-MM-DD format Example: 2020-12-25
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

    /**
     * @authenticated
     * @group Conference
     * Create or update multiple tasks by import
     * 
     * @urlParam conference required The conference's key Example: chi20
     */
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
     * @authenticated
     * @group Conference
     * Reset all SVs to 'enrolled' state
     * 
     * @urlParam conference required The conference's key Example: chi20
     * 
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
     * @authenticated
     * @group Conference
     * Run the auction
     * 
     * @urlParam conference required The conference's key Example: chi20
     * @urlParam day required The day to run the auction for Example: 2020-07-01
     * 
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
     * @authenticated
     * @group Conference
     * Run the lottery
     * 
     * @urlParam conference required The conference's key Example: chi20
     * 
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
     * @authenticated
     * @group Conference
     * Get all assignments and users which match the query
     * 
     * @urlParam conference required The conference's key Example: chi20
     * @queryParam search string Search string Example: A
     * @queryParam day string Limit to specific day YYYY-MM-DD Example: 2020-07-01
     * @queryParam interval array<string> Limit the time, has two items Example: ["07:00:00", "20:15:00"]
     * @queryParam sort_by Key to sort for Example: start_at
     * @queryParam sort_order Order to sort for Example: asc
     * @queryParam per_page Assignments per page Example: 5
     * @queryParam page Assignments per page Example: 1
     * 
     * @return \Illuminate\Http\Response All tasks for the requested params
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
        $search = request()->search;
        $day = request()->day;
        $interval = collect(json_decode(request()->interval));
        $doneState = State::byName('done', "App\Assignment");

        $query = Task
            ::with([
                'assignments',
                'assignments.notes',
                'assignments.notes.creator:id,firstname,lastname',
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
                'usersWithAssignment.avatar'
            ])
            // Stay bond to this $conference
            ->where('tasks.conference_id', $conference->id)
            ->whereDate('tasks.date', $day)
            ->orderBy(request()->sort_by, request()->sort_order);

        if ($interval && $interval->isNotEmpty()) {
            // Filter for the desired start and end time
            if (isset($interval[0]) && $interval[0]) {
                $query->whereTime('tasks.start_at', '>=', $interval[0]);
            }
            if (isset($interval[1]) && $interval[1]) {
                $query->whereTime('tasks.end_at', '<=', $interval[1]);
            }
        }

        if ($search && strlen($search) > 0) {
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
                    $nUser = $user->only(["firstname", "lastname", 'id']);
                    if ($user->avatar) {
                        $nUser['avatar'] = ['web_path' => $user->avatar->web_path];
                    }
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

                    $nAssignment = $assignment->only(['id', 'hours', 'state', 'user', 'notes']);

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
     * Calculate the array with tasks
     * for the requested params
     */
    public function prepareTasks(
        $conference,
        $user,
        $search,
        $days,
        $interval,
        $priorities,
        $onlyOwnTasks,
        $sortBy,
        $sortOrder,
        $perPage,
        $paginate
    ) {
        // Determine if we can show more infos based on if
        // the user is only an SV or also Chair/Captain
        $showMore = $user->isAdmin() || $user->isChair($conference) || $user->isCaptain($conference);

        // If the user is no admin, chair, captain or accepted SV, reject access
        if (!$showMore && !$user->isSv($conference, State::byName('accepted'))) {
            abort(403);
        }
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
            ]);

        if ($priorities && $priorities->isNotEmpty()) {
            // Filter for the desired priorities
            $query->whereIn('tasks.priority', $priorities);
        }

        if ($interval && $interval->isNotEmpty()) {
            // Filter for the desired start and end time
            if (isset($interval[0]) && $interval[0]) {
                $query->whereTime('tasks.start_at', '>=', $interval[0]);
            }
            if (isset($interval[1]) && $interval[1]) {
                $query->whereTime('tasks.end_at', '<=', $interval[1]);
            }
        }

        // Stay bound to this $conference
        $query->where('tasks.conference_id', $conference->id);

        if ($days && $days->isNotEmpty()) {
            $query->where(function ($query) use ($days) {
                foreach ($days as $day) {
                    $query->orWhereDate('tasks.date', $day);
                }
            });
        }

        if ($sortBy && $sortOrder) {
            $query->orderBy($sortBy, $sortOrder);
        }

        if ($onlyOwnTasks) {
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

        if ($paginate) {
            $tasks = $query->paginate($perPage);
        } else {
            $tasks = $query->get();
        }

        $tasks->transform(function ($task) use (&$showMore, &$user, &$userIsAccepted) {
            $safe = null;
            $safe = $task->only('id', 'name', 'location', 'description', 'start_at', 'end_at', 'hours');
            $safe["date"] = $task->date->toDateString();

            if ($showMore) {
                $safe["slots"] = $task->slots;
                $safe["priority"] = $task->priority;
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
     * @authenticated
     * @group Conference
     * Get all tasks which match the query
     * 
     * @urlParam conference required The conference's key Example: chi20
     * @queryParam search string Search string Example: A
     * @queryParam days array of strings. Limit to array of specific days YYYY-MM-DD Example: ["2020-07-01", "2020-07-03"]
     * @queryParam priorities array of ints. Limit to array of specific priorities Example: [1,2,3]
     * @queryParam interval array of strings. Limit the time, has two items Example: ["07:00:00", "20:15:00"]
     * @queryParam sort_by Key to sort for Example: tasks.start_at
     * @queryParam sort_order Order to sort for Example: asc
     * @queryParam per_page Tasks per page Example: 5
     * @queryParam page Page to return Example: 1
     * 
     * @return \Illuminate\Http\Response All tasks for the requested params
     */
    public function tasks(Conference $conference)
    {
        $search = request()->search;
        $days = collect(json_decode(request()->days));
        abort_unless($days, 400, "Invalid days parameter. Requires JSON array");

        $priorities = collect(json_decode(request()->priorities));
        $interval = collect(json_decode(request()->interval));
        $onlyOwnTasks = intval(request()->only_own_tasks) == 1 ? true : false;
        $perPage = request()->per_page;
        $paginate = true;
        $sortBy = request()->sort_by;
        $sortOrder = request()->sort_order;


        return $this->prepareTasks(
            $conference,
            auth()->user(),
            $search,
            $days,
            $interval,
            $priorities,
            $onlyOwnTasks,
            $sortBy,
            $sortOrder,
            $perPage,
            $paginate
        );
    }

    /**
     * @authenticated
     * @group Conference
     * Get all days where the conference has tasks
     * We need this for the calendar in the GUI
     * 
     * @urlParam conference required The conference's key Example: chi20
     * Return an Array with all days where the conference has
     * tasks. 
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
     * @authenticated
     * @group Conference
     * Get all users which are suited to be assigned for a specific task
     * 
     * @urlParam conference required The conference's key Example: chi20
     * @urlParam task required The task's id Example: 1
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
        $search = request()->search;

        $query = $conference
            ->users($roleSv)
            ->where('state_id', $stateAccepted->id)
            ->with([
                'avatar',
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
            $cleanUser['avatar'] = collect($sv->avatar)->only(['web_path']);

            // Sum up all hours already done
            $hoursDone = $sv->assignments->where("state_id", $stateDone->id)->sum("hours");
            // // Sum up all the hours the SV will likely do
            $hoursNotDone = $sv
                ->assignments
                ->filter(function ($assignment) use ($task, $stateAssigned, $stateCheckedIn) {
                    return ($assignment->state_id == $stateAssigned->id
                        || $assignment->state_id == $stateCheckedIn->id);
                })
                ->sum("hours");

            $cleanUser['stats']['hours_done'] = round($hoursDone, 2);
            $cleanUser['stats']['hours_not_done'] = round($hoursNotDone, 2);


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
                $sv['bid'] ? -$sv['bid']['preference'] : -1,
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
     * @authenticated
     * @group Conference
     * Get all users of a conference matching the query
     * 
     * @urlParam conference required The conference's key Example: chi20
     * @queryParam search string Search string Example: A
     * @queryParam only_states array of ints. Limit to array of specific states Example: [11,12,13,14]
     * @queryParam sort_by Key to sort for Example: lastname
     * @queryParam sort_order Order to sort for Example: desc
     * @queryParam per_page Users per page Example: 2
     * @queryParam page Page to return Example: 1
     * 
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
        $searchString = request()->search;
        $selectedStates = collect(json_decode(request()->only_states));
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
                'user.assignments.notes',
                'user.assignments.notes.creator:id,firstname,lastname',
                'user.assignments.notes.for:id,task_id,hours',
                'user.assignments.notes.for.task:id,name,hours,start_at,end_at',
                'user.bids' => function ($query) use ($conference) {
                    $query->select(['id', 'preference', 'user_id', 'task_id', 'state_id']);
                    $query->whereHas('task', function ($query) use ($conference) {
                        $query->where('conference_id', $conference->id);
                    });
                },
                'user.bids.task' => function ($query) use ($conference) {
                    $query->where('conference_id', $conference->id);
                },
                'user.notes' => function ($query) use ($conference) {
                    $query->where('conference_id', $conference->id);
                },
                'user.notes.creator:id,firstname,lastname',
                'user.notes.for',
                'user.university',
                'user.avatar',
                'user.country',
                'user.region',
                'user.city',
                'user.degree',
                'user.languages',
                'state',
                'enrollmentForm'
            ])
            // We have to join users to make it (1) searchable (2) sortable
            ->join('users', 'permissions.user_id', '=', 'users.id')
            // We have to join enrollment_forms to make it sortable
            ->leftJoin('enrollment_forms', 'permissions.enrollment_form_id', '=', 'enrollment_forms.id')
            // We have to join universities to make it sortable
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
            $safe['country'] = $user->country ? $user->country->name : null;
            $safe['region'] = $user->region ? $user->region->name : null;

            // Add statistics for chair/captain and the requesting user
            if ($showMore || $user->id == auth()->user()->id) {
                $bids = $user->bids->filter(function ($bid) use (&$conference) {
                    return $bid->task->conference_id = $conference->id;
                });


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
                    $safe = $assignment->only('id', 'hours', 'created_at', 'notes');
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

                $safe['past_conferences'] = $user->past_conferences;
                $safe['past_conferences_sv'] = $user->past_conferences_sv;
                $safe['languages'] = $user->languages->map(function ($language) {
                    return collect($language)->only(['id', 'name']);
                });
            }


            if ($showMore) {
                // Show more information for captain and chair only
                $conference = $permission->conference;
                $safe['email'] = $user->email;
                $safe['degree'] = $user->degree->name;
                $safe['city'] = $user->city ? $user->city->name : '';
                $safe['permission']->id = $permission->id;
                $safe['permission']->lottery_position = $permission->lottery_position;
                $safe['permission']->created_at = $permission->created_at;
                $safe['permission']->enrollment_form = $permission->enrollmentForm ? $permission->enrollmentForm->only(['name', 'id', 'parent_id', 'body', 'total_weight']) : null;
                $safe['permission']->conference = new Conference();
                $safe['permission']->conference->id = $conference->id;
                $safe['permission']->role = new Role();
                $safe['permission']->role->id = $permission->role->id;
                $safe['notes'] = $user->notes;

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
     * @group Conference
     * Get a preview of all open conferences for public display
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPreview()
    {
        $conferences = Conference
            ::with([
                'icon:owner_id,web_path',
                'artwork:owner_id,web_path',
                'state',
            ])
            ->whereHas('state', function ($query) {
                $query->where('id', State::byName('enrollment')->id);
                $query->orWhere('id', State::byName('running')->id);
                $query->orWhere('id', State::byName('registration')->id);
            })
            ->orderBy('start_date', 'desc')
            ->get(['id', 'name', 'location', 'state_id']);

        return $conferences->values();
    }

    /**
     * @authenticated
     * @group Conference
     * Get all conferences based on user's permissions
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conferences = Conference
            ::with('icon', 'artwork', 'state', 'timezone')
            ->orderBy('start_date', 'desc')
            ->get()
            ->filter(function ($conference) {
                return auth()->user()->can('view', $conference);
            });

        return $conferences->values();
    }


    /**
     * @authenticated
     * @group Conference
     * Enroll a user to be an SV for the conference with state 'enrolled'
     * Use a dictionary of field names as keys value pairs.
     * Use the field names from the currently active enrollment form. The
     * fields below are just examples.
     * 
     * @urlParam conference required The conference's key Example: chi20
     * @urlParam user The user's id. Defaults to the authenticated user when missing Example: 1
     * @bodyParam id int required The referencing enrollment form id. Example: 1
     * @bodyParam [fields] type required Each field of the referencing enrollment form. Can be multiple and is highly dynamic.
     * 
     * @response {
     * "result":true,"message":"You are now enrolled"
     * }
     * 
     * @response 422 {
     * "message":"The given data was invalid.","errors":{"why_you_want_to_be_sv":["'Why You Want To Be Sv' has to have some text","'Why You Want To Be Sv' has to be provided"]}
     * }
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
            return ["result" => false, "message" => "There was an error while creating the enrollment form"];
        }

        $enrollmentForm->updateTotalWeight();
        $permission = new Permission();
        $permission->conference()->associate($conference);
        $permission->user()->associate($user);
        $permission->state()->associate(State::byName('enrolled'));
        $permission->role()->associate(Role::byName('sv'));
        $permission->enrollmentForm()->associate($enrollmentForm);

        // Create the permission
        $permission->save();

        if (!$permission) {
            return ["result" => false, "message" => "There was an error while granting SV permissions"];
        }

        return ["result" => true, "message" => "You are now enrolled"];
    }

    /**
     * @authenticated
     * @group Conference
     * Update enrollment form weights based on submitted weights
     * Use a dictionary of field names as keys value pairs.
     * Use the field names from the currently active enrollment form. The
     * fields below are just examples.
     * 
     * @urlParam conference required The conference's key Example: chi20
     * @bodyParam attended_before int required An example field Example: 5
     * @bodyParam know_city int required An example field Example: -15
     * @bodyParam need_visa int required An example field Example: 0
     * @bodyParam sved_before int required An example field Example: 30
     * 
     * Update all enrollmentForms of a conference with new weights
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
     * @authenticated
     * @group Conference
     * Unenrolls a user from the conference
     * 
     * @urlParam conference required The conference's key Example: chi20
     * @urlParam user The user's id. Defaults to the authenticated user when missing Example: 1
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
     * @authenticated
     * @group Conference
     * Update a conference
     * 
     * @urlParam conference required The conference's key Example: chi20
     * @bodyParam name string required Conference's name Example: CHI 2020
     * @bodyParam key string required Conference's key Example: chi20
     * @bodyParam location string required Conference's location Example: Hawaii
     * @bodyParam timezone_id int required Conference's timezone Example: 366
     * @bodyParam start_date string required First day Example: 2020-07-01
     * @bodyParam end_date string required Last day Example: 2020-07-07
     * @bodyParam description string required Markdown description of the conference Example: !CHI 2020
     * @bodyParam url_name string required Caption for the button on the conference view Example: ACM
     * @bodyParam url string required Url for the button on the conference view Example: https://acm.org
     * @bodyParam enrollment_form_id int required Conference will use this enrollment form Example: 1
     * @bodyParam state_id int required State by id Example: 2
     * @bodyParam volunteer_hours int required How long SVs are expected to work Example: 20
     * @bodyParam volunteer_max int required How many SVs should be accepted for the conference Example: 100
     * @bodyParam email_chair string required The SV-Chairs e-mail which is used in the reply field of every e-mail Example: sv@example.com
     * @bodyParam bidding_enabled boolean required Bidding is enabled true/false Example: true
     * @bodyParam bidding_start string required Bidding open after this day Example: 2020-07-01
     * @bodyParam bidding_end string required Bidding open before this day Example: 2020-07-07
     * 
     * @response 200 {
     * "result": true,"message": "Conference updated"
     * }
     * 
     * @response 404 {
     * "message": "No query results for model [App\\Conference] chi404"
     * }
     * 
     * @response 422 {
     * "message":"The given data was invalid.","errors":{"description":["Please give a short intro into the conference"]}
     * }
     * 
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

        return ["result" => $result, "message" => "Conference updated"];
    }

    /**
     * @authenticated
     * @group Conference
     * Delete a conference
     * 
     * @urlParam conference required The conference's key Example: chi20
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
}
