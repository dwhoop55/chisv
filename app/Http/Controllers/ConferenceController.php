<?php

namespace App\Http\Controllers;

use App\Conference;
use App\Country;
use App\EnrollmentForm;
use App\Http\Requests\ConferenceCreateRequest;
use App\Http\Requests\ConferenceUpdateRequest;
use App\Http\Requests\EnrollRequest;
use App\State;
use App\Timezone;
use App\User;
use App\Image;
use App\Role;
use App\Http\Resources\Conferences;
use App\Permission;
use App\Region;
use App\Services\EnrollmentFormService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

use function PHPSTORM_META\type;

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
        $permissions = $conference->permissions
            ->where('role_id', Role::byName('sv')->id)
            ->where('state_id', '!=', State::byName('enrolled')->id);

        $total = 0;
        foreach ($permissions as $permission) {
            $permission->state()->associate(State::byName('enrolled'));
            $permission->lottery_position = null;
            $permission->save();
            $total++;
        }

        return ["result" => $total, "message" => "$total SVs have been reset to state 'enrolled'"];
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

        $total = [
            'processed' => 0,
            'accepted' => 0,
            'waitlisted' => 0,
            'still_waitlisted' => 0
        ];

        // First we give out new lottery positions to all the 'enrolled'
        // SVs
        $permissionsToPosition = $conference->permissions
            ->where('role_id', Role::byName('sv')->id)
            ->where('state_id', State::byName('enrolled')->id);

        // Randomly order the permissions for the lottery
        $permissionsToPosition = $permissionsToPosition->shuffle();

        // Get the largest lottery position and assign new SVs
        // a number larger
        $maxPosition = $conference->permissions->max('lottery_position');

        // Give out the numbers
        foreach ($permissionsToPosition as $permission) {
            $permission->lottery_position = ++$maxPosition;
            $permission->save();
            $total['processed']++;
        }

        // Second we need to accept SVs ('enrolled' and 'waitlisted')
        // For that we need to know the free slots:
        $openPositions = ($conference->volunteer_max)
            - ($conference
                ->permissions
                ->where('state_id', State::byName('accepted')->id)
                ->count());

        // Since Elloquent has easier api for AND WHERE we negate the argument
        $permissionsToAccept = $conference->permissions
            ->where('role_id', Role::byName('sv')->id)
            ->where('state_id', '!=', State::byName('dropped')->id)
            ->where('state_id', '!=', State::byName('accepted')->id)
            ->sortBy('lottery_position');

        // Loop through all permissions which have to be accepted
        foreach ($permissionsToAccept as $permission) {
            if ($total['accepted'] < $openPositions) {
                // Still slots available for SVs,
                // make the current SV 'accepted'
                $permission->state()->associate(State::byName('accepted'));
                $total['accepted']++;
            } else if ($permission->state != State::byName('waitlisted')) {
                // No more slots, put the SV which is not on the
                // waitlist yet on the waitlist 
                $permission->state()->associate(State::byName('waitlisted'));
                $total['waitlisted']++;
            }
            $permission->save();
        }

        return ["result" => $total, "message" => "The lottery assigned new positions to "
            . $total['processed'] . " SVs. The first "
            . $total['accepted'] . " in the line (lottery position) were accepted due to free slots. "
            . $total['waitlisted'] . " have been waitlisted."];
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
        $this->authorize('viewUsers', $conference);
        $showMore =
            auth()->user()->isAdmin()
            || auth()->user()->isChair(request()->conference)
            || auth()->user()->isCaptain(request()->conference);
        $conference = request()->conference;

        $svs = $conference->users(Role::byName('sv'))->get();

        // We need to design our returned user objects in a special way
        // since also SVs can sniff these from the dev tools
        $svs = $svs->map(function ($user) use ($showMore, $conference) {
            $safeUser = null;
            $safeUser = $user->only('firstname', 'lastname', 'id');
            $safeUser['avatar'] = $user->avatar;
            $safeUser['university'] = $user->university ? $user->university->name : $user->university_fallback;
            $safeUser['permission'] = new Permission();
            $fullPermission = $user->svPermissionFor($conference);
            $safeUser['permission']->state = new State();
            $safeUser['permission']->state->id = $fullPermission->state->id;
            $safeUser['permission']->state->name = $fullPermission->state->name;
            $safeUser['permission']->state->description = $fullPermission->state->description;
            $safeUser['country'] = $user->country->name;
            $safeUser['region'] = $user->region->name;

            if ($showMore) {
                // Show more information
                $safeUser['email'] = $user->email;
                $safeUser['degree'] = $user->degree->name;
                $safeUser['city'] = $user->city->name;
                $safeUser['shirt'] = $user->shirt->name;
                $safeUser['permission']->id = $fullPermission->id;
                $safeUser['permission']->lottery_position = $fullPermission->lottery_position;
                $safeUser['permission']->created_at = $fullPermission->created_at;
                $safeUser['permission']->enrollment_form = $fullPermission->enrollmentForm->only(['name', 'id', 'parent_id', 'body', 'total_weight']);
                $safeUser['permission']->conference = new Conference();
                $safeUser['permission']->conference->id = $fullPermission->conference->id;
                $safeUser['permission']->role = new Role();
                $safeUser['permission']->role->id = $fullPermission->role->id;
            }
            return $safeUser;
        });
        return $svs->unique()->values();
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
            'enable_bidding'
        );

        $result = $conference->update($data);
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