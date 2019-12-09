<?php

namespace App\Http\Controllers;

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
        return $conference;
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
            'payload' => $conference,
        ]);
        $job->saveAndDispatch();
        return ["result" => $job->id, "message" => "Resetting SVs to 'enrolled' at $conference->name has been queued as a new job"];
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
            'payload' => $conference,
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
    public function assignment(Conference $conference)
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
            // join assignments to then join users
            ::leftJoin('assignments', 'assignments.task_id', '=', 'tasks.id')
            ->leftJoin('users', 'assignments.user_id', '=', 'users.id')
            // Stay bond to this $conference
            ->where('tasks.conference_id', $conference->id)
            ->whereDate('tasks.date', $day)
            ->groupBy('tasks.id')
            ->orderBy(request()->sort_by, request()->sort_order);

        // Only add queries when we are searching for something
        if (strlen($search) > 0) {
            $query->where(function ($query) use ($search) {
                $query->orWhere('tasks.name', 'LIKE', '%' . $search . '%');
                $query->orWhere('tasks.location', 'LIKE', '%' . $search . '%');
            });
        }

        // Load the paginated results from the database
        // Only retreive 'tasks.*' or we would have collision
        // due to the joins we did earlier
        $paginatedTasks = $query->paginate(request()->per_page, ['tasks.*']);

        // Now we have a collection which can have multiple items with the same task
        // That is because we used left join and every assignment->user match results
        // in a new item in the collection. We will now have to go through all these
        // items and push the to a cleaner collection - but only once for every
        // occurence. Based on the resulting collection we then load the assignments
        // and users back in again. This way the task and the user is searchable
        // from the frontend but send back over to the frontend efficiently
        $uniqueTasks = collect();
        $paginatedTasks->each(function ($task) use ($uniqueTasks) {
            if (!$uniqueTasks->has($task->id)) {
                $task->assignments = $task->assignments->transform(function ($assignment) {
                    $cleanAssignment = $assignment->only(['id', 'task_id', 'override_hours']);
                    $cleanAssignment['user'] = $assignment->user->only('id', 'firstname', 'lastname');
                    return $cleanAssignment;
                });
                $uniqueTasks->put($task->id, $task);
            }
        });

        return ["data" => $uniqueTasks, "total" => $uniqueTasks->count()];
    }

    /**
     * Show all tasks for a conference
     * which match the params
     * 
     * @return \Illuminate\Http\Response All tasks for the requestes params
     */
    public function task(Conference $conference)
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

        $query = Task::
            // Stay bond to this $conference
            where('tasks.conference_id', $conference->id)
            ->whereDate('tasks.date', $day)
            ->orderBy(request()->sort_by, request()->sort_order);

        // Only add queries when we are searching for something
        if (strlen($search) > 0) {
            $query->where(function ($query) use ($search) {
                $query->orWhere('tasks.name', 'LIKE', '%' . $search . '%');
                $query->orWhere('tasks.location', 'LIKE', '%' . $search . '%');
            });
        }

        $query->where(function ($query) use ($priorities) {
            foreach ($priorities as $priority) {
                $query->orWhere('priority', $priority);
            }
        });

        // Load the paginated results from the database
        // Only retreive 'tasks.*' or we would have collision
        // due to the joins we did earlier
        $paginatedTasks = $query->paginate(request()->per_page, ['tasks.*']);

        $paginatedTasks->getCollection()->transform(function ($task) use ($user, $conference) {
            // Remove some fields when the user is not admin, chair or captain
            if (!$user->isAdmin() || $user->isChair($conference) || $user->isCaptain($conference)) {
                unset($task->slots);
                unset($task->priority);
            }

            // Provide some dummy bid so that the frontend can fill it out
            $task->own_bid = new Bid([
                'user_id' => $user->id,
                'task_id' => $task->id,
            ]);

            foreach ($task->bids as $bid) {
                if ($bid->user_id == $user->id) {
                    $cleanBid = collect($bid->only(['id', 'preference', 'state']));
                    $task->own_bid = $cleanBid;
                    $task->own_bid->put('can_update', $user->can('update', $bid));
                    // We found the one bid from the user
                    // due to the database scheme there can only
                    // be one bid per user per task, so we can
                    // break the loop now
                    break;
                }
            }

            $task->can_create_bid = $user->can('createForTask', ['App\Bid', $task]);
            return $task;
        });

        return $paginatedTasks;
    }

    /**
     * Return an Array with all days where the conference has
     * tasks. We need this for the calendar in the GUI
     * 
     * @return Collection<Carbon>
     */
    public function taskDays(Conference $conference)
    {
        $tasks = $conference->tasks->sortBy('date');

        $days = collect();

        foreach ($tasks as $task) {
            $day = $task->date->toDateString();
            if ($days->has($day)) {
                $days[$day] = $days[$day] + 1;
            } else {
                $days->put($day, 1);
            }
        }

        return $days;
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
    public function sv(Conference $conference)
    {
        // Determine if we can show more infos based on if
        // the user is only an SV or also Chair/Captain
        $showMore =
            auth()->user()->isAdmin()
            || auth()->user()->isChair($conference)
            || auth()->user()->isCaptain($conference);
        $searchString = request()->search_string;
        $selectedStates = collect(explode(',', request()->selected_states));

        // Do the actual query
        $query = Permission
            ::with('user')
            // We have to join users to make it (1) searchable (2) sortable
            ->join('users', 'permissions.user_id', '=', 'users.id')
            // We have to join enrollment_forms to make it sortable
            ->join('enrollment_forms', 'permissions.enrollment_form_id', '=', 'enrollment_forms.id')
            // We have to join universities to make it searchable
            ->join('universities', 'users.university_id', '=', 'universities.id')
            // Stay bond to this $conference and 'sv' state
            ->where('conference_id', $conference->id)
            ->where("role_id", Role::byName('sv')->id)
            ->orderBy(request()->sort_by, request()->sort_order);

        // Only add queries when we are searching for something
        if (strlen($searchString) > 0) {
            $query->where(function ($query) use ($searchString) {
                $query->orWhere('users.firstname', 'LIKE', '%' . $searchString . '%');
                $query->orWhere('users.lastname', 'LIKE', '%' . $searchString . '%');
                $query->orWhere('universities.name', 'LIKE', '%' . $searchString . '%');
                $query->orWhere('users.email', 'LIKE', '%' . $searchString . '%');
            });
        }

        $query->where(function ($query) use ($selectedStates) {
            foreach ($selectedStates as $state) {
                $query->orWhere('state_id', $state);
            }
        });

        // Load the paginated results from the database
        // Only retreive 'permissions.*' or we would have collision
        // due to the joins we did earlier
        $paginatedPermissions = $query->paginate(request()->per_page, ['permissions.*']);

        // We need to design our returned user objects in a special way
        // since also SVs can sniff these from the dev tools
        $paginatedPermissions->getCollection()->transform(function ($permission) use ($showMore, $conference) {
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

            if ($showMore) {
                // Show more information
                $safe['email'] = $user->email;
                $safe['degree'] = $user->degree->name;
                $safe['city'] = $user->city->name;
                $safe['permission']->id = $permission->id;
                $safe['permission']->lottery_position = $permission->lottery_position;
                $safe['permission']->created_at = $permission->created_at;
                $safe['permission']->enrollment_form = $permission->enrollmentForm->only(['name', 'id', 'parent_id', 'body', 'total_weight']);
                $safe['permission']->conference = new Conference();
                $safe['permission']->conference->id = $permission->conference->id;
                $safe['permission']->role = new Role();
                $safe['permission']->role->id = $permission->role->id;
                if ($permission->state == State::byName('waitlisted')) {
                    $safe['permission']->waitlist_position = $permission->waitlist_position;
                }
            }
            return $safe;
        });

        return $paginatedPermissions;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conferences = Conference::orderBy('start_date', 'desc')->get()->filter(function ($conference) {
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