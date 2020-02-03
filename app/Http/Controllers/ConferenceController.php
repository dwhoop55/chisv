<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Bid;
use App\Conference;
use App\Http\Requests\ConferenceCreateRequest;
use App\Http\Requests\ConferenceUpdateRequest;
use App\Http\Requests\EnrollRequest;
use App\State;
use App\User;
use App\Role;
use App\Http\Resources\Conferences;
use App\Job;
use App\Permission;
use App\Services\EnrollmentFormService;
use App\Task;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

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
        return $conference->loadMissing(['icon', 'artwork']);
    }
    /**
     * Delete all assignments of a signle day
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

        $date = Carbon::create($date);
        $job = new Job([
            'handler' => 'App\Jobs\DeleteAllAssignments',
            'name' => "Delete all assignments for " . $conference->key . " " . $date->toDateString(),
            'payload' => ["conference_id" => $conference->id, "date" => $date]
        ]);
        $job->saveAndDispatch();
        return ["result" => $job->id, "message" => "Delete all assignments for $conference->name on " . $date->toDateString() . " has been queued as a new job"];
    }

    /**
     * Reset all SVs to 'enrolled' state
     * @return \Illuminate\Http\Response
     */
    public function resetEnrollmentsToEnrolled(Conference $conference)
    {
        $job = new Job([
            'handler' => 'App\Jobs\ResetToEnrolled',
            'name' => "Reset SVs to enrolled for " . $conference->key,
            'payload' => ["conference_id" => $conference->id]
        ]);
        $job->saveAndDispatch();
        return ["result" => $job->id, "message" => "Resetting SVs to 'enrolled' at $conference->name has been queued as a new job"];
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
        $job->saveAndDispatch();
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
        $search = request()->search_string;
        $day = request()->day;
        $user = auth()->user();

        abort_unless(
            $user->can('viewAssignments', $conference),
            403,
            'You have no permission to see any assignments for this conference!'
        );

        $query = Task
            ::with('assignments')
            // join assignments to then join users
            ->leftJoin('assignments', 'assignments.task_id', '=', 'tasks.id')
            ->leftJoin('users', 'assignments.user_id', '=', 'users.id')
            // Stay bond to this $conference
            ->where('tasks.conference_id', $conference->id)
            // Only the given day
            ->whereDate('tasks.date', $day)
            // Order and sort the results as expected
            ->orderBy(request()->sort_by, request()->sort_order);

        // Only add queries when we are searching for something
        if (strlen($search) > 0) {
            $query->where(function ($query) use ($search) {
                $query->orWhere('tasks.name', 'LIKE', '%' . $search . '%');
                $query->orWhere('tasks.location', 'LIKE', '%' . $search . '%');
                $query->orWhere('users.firstname', 'LIKE', '%' . $search . '%');
                $query->orWhere('users.lastname', 'LIKE', '%' . $search . '%');
            });
        }

        $tasksWithUsers = $query->get([
            'tasks.*'
        ]);

        // Now we have a collection which can have multiple items with the same task
        // That is because we used left join and every assignment->user match results
        // in a new item in the collection. We will now have to go through all these
        // items and push them to a cleaner collection - but only once for every
        // occurence. Based on the resulting collection we then load the assignments
        // and users back in again. This way the task and the user is searchable
        // from the frontend but send back over to the frontend efficiently
        $uniqueTasks = collect();
        $tasksWithUsers->each(function ($task) use ($uniqueTasks) {
            // Only do the following once per task (unique in uniqueTasks)
            if (!$uniqueTasks->has($task->id)) {
                // Attach assignments - this is on a per-sv level
                $task->assignments = $task->assignments->transform(function ($assignment) use ($task) {
                    $cleanAssignment = $assignment->only(['id', 'task_id', 'hours', 'state']);

                    // Add the bid to the assignment if there is any
                    if ($assignment->bid()) {
                        $cleanAssignment['bid'] = $assignment->bid()->only(['id', 'preference', 'state']);
                        $cleanAssignment['bid']['state'] = $cleanAssignment['bid']['state']->only(['id', 'name']);
                    }

                    // Add the state which the assignment is in
                    $cleanAssignment['state'] = $cleanAssignment['state']->only('id', 'name');

                    // Now we add the user with some of statistics
                    $user = $assignment->user->only('id', 'firstname', 'lastname');
                    $hours = $assignment->user->hoursFor($assignment->task->conference, State::byName('done', "App\Assignment"));
                    $user['hours_done'] = $hours;
                    $cleanAssignment['user'] = $user;

                    // Check for multiple assignments at time period
                    $cleanAssignment['tasks_at_time'] = ($assignment->user->tasksAtTime($task));

                    return $cleanAssignment;
                });

                // Attach all bids for this task and only keep important fields
                $task->bids = $task->bids->transform(function ($bid) {
                    $cleanBid = $bid->only(['id', 'preference', 'user_id']);
                    $cleanBid['state'] = $bid->state->only(['id', 'name']);
                    return $cleanBid;
                });

                $uniqueTasks->put($task->id, $task);
            }
        });

        // Now we paginate on the collection (note this is a custom marco registered in AppServiceProvider)
        $paginatedTasks = $uniqueTasks->flatten()->paginate(request()->per_page);

        return $paginatedTasks;
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
        $showMore =
            auth()->user()->isAdmin()
            || auth()->user()->isChair($conference)
            || auth()->user()->isCaptain($conference);
        $search = request()->search_string;
        $day = request()->day;
        $priorities = collect(explode(',', request()->priorities));
        $user = auth()->user();
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
                'users',
                'conference'
            ])
            // Left join assignments to filter for 'onlyOwnTasks'
            // leftJoin('assignments', 'assignments.task_id', '=', 'tasks.id')
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
        $tasks = $conference
            ->tasks()
            ->groupBy('date')
            ->get('date')
            ->transform(function ($task) {
                return $task->date->toDateString();
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
        $statePlaced = State::byName('placed', 'App\Bid');
        $stateSuccessful = State::byName('successfull', 'App\Bid');
        $stateDone = State::byName('done', 'App\Assignment');
        $roleSv = Role::byName('sv');
        $search = request()->search_string;

        $query = $conference
            ->users($roleSv)
            ->with(['bids', 'assignments', 'assignments.task']);

        if ($search != "") {
            $query = $query->where(function ($query) use ($search) {
                $query->where('firstname', 'LIKE', '%' . $search . '%');
                $query->orWhere('lastname', 'LIKE', '%' . $search . '%');
            });
        }

        $svs = $query->get();

        // Now we need to sort through all bids and only keep then once which
        // match the given task
        // Since we loop through all users anyway we use this chance to also
        // minimize the data model
        // We will return null so that we can later sanitize the collection
        // dd(json_encode($svs));
        $svs->transform(function ($sv) use ($task, $conference, &$statePlaced, &$stateSuccessful, &$stateDone) {

            $bid = null;
            // We reverse it since newer bids are at the end of the list
            // This will help us to break from the loop earlier
            // We have this in the datamodel already, no need to touch the database
            $bids = $sv->bids->reverse();
            foreach ($bids as $eBid) {
                if ($eBid->task_id == $task->id) {
                    $bid = $eBid->only('id', 'preference');
                    break;
                }
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
            $hoursDone = 0;
            $sv->assignments->each(function ($assignment) use (&$hoursDone, &$stateDone) {
                if ($assignment->state_id == $stateDone->id) {
                    $hoursDone += $assignment->hours;
                }
            });
            $cleanUser['stats']['hours_done'] = round($hoursDone, 2);

            $cleanUser['stats']['bids_placed'] = [
                $bids->where('conference_id', $conference->id)->where('preference', 0)->count(),
                $bids->where('conference_id', $conference->id)->where('preference', 1)->count(),
                $bids->where('conference_id', $conference->id)->where('preference', 2)->count(),
                $bids->where('conference_id', $conference->id)->where('preference', 3)->count(),
            ];

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
        $limit = 20;
        $subset = $svs->forPage(1, $limit)->values();
        return ["total_matches" => $count, "returned_matches" => $limit, "svs" => $subset];
    }

    public function svsCount(Conference $conference)
    {
        $svRole = Role::byName('sv');
        $acceptedState = State::byName('accepted');
        return [
            "result" => $conference
                ->permissions($svRole)
                ->where('state_id', $acceptedState->id)
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
        $selectedStates = collect(explode(',', request()->selected_states));
        $sortBy = request()->sort_by ?? 'lastname';
        $sortOrder = request()->sort_order ?? 'asc';
        $perPage = request()->per_page ?? '10';
        $roleSv = Role::byName('sv');
        $stateWaitlisted = State::byName('waitlisted');
        $stateSuccessful = State::byName('successful', 'App\Bid');
        $stateDone = State::byName('done', 'App\Assignment');

        // Do the actual query
        $query = Permission
            ::with([
                'user',
                'user.assignments',
                'user.assignments.state',
                'user.assignments.task',
                'user.bids',
                'user.bids.task',
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
        if (request()->selected_states) {
            $query->whereIn("state_id", $selectedStates);
        }

        // Load the paginated results from the database
        // Only retreive 'permissions.*' or we would have collision
        // due to the joins we did earlier
        $paginated = $query->paginate($perPage, ['permissions.*']);

        // We need to design our returned user objects in a special way
        // since also SVs can sniff these from the dev tools

        $paginated->getCollection()->transform(function ($permission) use (&$showMore, &$conference, &$stateDone, &$stateSuccessful, &$stateWaitlisted) {
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
                // Sum up all hours already done
                $hoursDone = 0;
                $user->assignments->each(function ($assignment) use (&$hoursDone, &$stateDone) {
                    if ($assignment->state_id == $stateDone->id) {
                        $hoursDone += $assignment->hours;
                    }
                });
                $safe['stats'] = [
                    "hours_done" => round($hoursDone, 2),
                    "bids_placed" => [
                        $bids->where('preference', 0)->count(),
                        $bids->where('preference', 1)->count(),
                        $bids->where('preference', 2)->count(),
                        $bids->where('preference', 3)->count()
                    ],
                    "bids_successful" => [
                        $bids->where('state_id', $stateSuccessful->id)->where('preference', 0)->count(),
                        $bids->where('state_id', $stateSuccessful->id)->where('preference', 1)->count(),
                        $bids->where('state_id', $stateSuccessful->id)->where('preference', 2)->count(),
                        $bids->where('state_id', $stateSuccessful->id)->where('preference', 3)->count(),
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
                $safe['city'] = $user->city->name;
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
        $conferences = Conference::with('icon', 'artwork')->orderBy('start_date', 'desc')->get()->filter(function ($conference) {
            return auth()->user()->can('view', $conference);
        });

        return new Conferences($conferences);
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
            ::where('conference_id', $conference->id)
            ->where('user_id', auth()->user()->id)
            ->where('role_id', Role::byName('sv')->id)->first();

        $enrollmentFormService = new EnrollmentFormService;

        // In any case, make sure that we remove the weights before
        // sending the form back to the user
        if ($permission && $permission->enrollmentForm) {
            // Return the filled enrollmentForm
            $form = $permission->enrollmentForm;
            $permission->enrollment_form = $enrollmentFormService->removeWeights($form);
            $permission->updateWaitlistPosition();
            return ["permission" => $permission];
        } else {
            // Return a new and empty form
            $form = $conference->templateEnrollmentForm;
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
            $weights = $enrollmentFormService->extractWeights($conference->templateEnrollmentForm);
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
            'bidding_until'
        );

        $result = $conference->update($data);
        $conference->refresh();
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
        $conferences = Conference::all()->filter(function ($conference) {
            return auth()->user()->can('view', $conference);
        });

        $user = auth()->user();
        $overState = State::byName('over');
        $planningState = State::byName('planning');

        return view('conference.index', compact('user', 'conferences', 'overState', 'planningState'));
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
        $overState = State::byName('over');
        $planningState = State::byName('planning');
        $user = auth()->user();
        // $fullContent = true;
        return view('conference.show', compact('fullContent', 'user', 'conference', 'overState', 'planningState'));
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