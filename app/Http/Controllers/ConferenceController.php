<?php

namespace App\Http\Controllers;

use App\Conference;
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
     * Show all users of a conference.
     *
     * @return \Illuminate\Http\Response
     */
    public function user(Conference $conference)
    {
        // First we filter the users, to only get the SVs
        $users = $conference->users->filter(function ($user) {
            return $user->isSv(request()->conference);
        });
        // We need to design our returned user objects in a special way
        // since also SVs can sniff these from the dev tools
        $users = $users->map(function ($user) {
            if (!$user->isSv(request()->conference)) {
                return;
            }
            $safeUser = null;
            $safeUser = $user->only('firstname', 'lastname', 'id');
            $safeUser['avatar'] = $user->avatar;
            $safeUser['university'] = $user->university ? $user->university : $user->university_fallback;
            $safeUser['sv_state'] = $user->svStateFor(request()->conference);
            $safeUser['sv_state']->created_at = $user->svPermissionFor(request()->conference)->created_at;
            if (
                auth()->user()->isAdmin()
                || auth()->user()->isChair(request()->conference)
                || auth()->user()->isCaptain(request()->conference)
            ) {
                // Show more information
                $safeUser['email'] = $user->email;
                $safeUser['degree'] = $user->degree;
                $safeUser['past_conferences'] = $user->past_conferences;
                $safeUser['past_conferences_sv'] = $user->past_conferences_sv;
                $safeUser['city'] = $user->city;
                $safeUser['shirt'] = $user->shirt;
                $safeUser['sv_permission'] = $user->svPermissionFor(request()->conference);
            } else {
                // SV
                // Only show basic information defined at the top
            }
            return $safeUser;
        });
        return $users->unique()->values();
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

        if ($permission) {
            return ["permission" => $permission];
        } else {
            return ["enrollment_form" => $conference->enrollmentForm->only('is_filled', 'body')];
        }
    }

    /** 
     * Enrolls a user to be an SV for the conference
     * 
     * @param \App\Conference conference
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

        $enrollmentForm = new EnrollmentForm($request->toArray());
        $permission = $user->grant(Role::byName('sv'), $conference, State::byName('enrolled'), $enrollmentForm);

        if ($permission) {
            return ["result" => $permission, "message" => "You are now enrolled"];
        } else {
            return ["result" => null, "message" => "There was an error while granting SV permissions"];
        }
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
            'state_id',
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