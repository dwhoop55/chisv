<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Bid;
use App\Conference;
use App\User;
use Illuminate\Http\Request;
use App\Degree;
use App\Shirt;
use App\Http\Resources\Users;
use App\Http\Requests\UserUpdateRequest;
use App\Image;
use App\Role;
use App\State;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(User::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $universityId = request()->university_id;
        $universityFallback = request()->university_fallback;
        $search = request()->search;

        $query = User
            ::with([
                'university:id,name',
                'permissions:user_id,role_id,state_id,conference_id',
                'permissions.role:id,name,description',
                'permissions.state:id,name,description',
                'permissions.conference:id,name,key',
            ])
            ->select(['id', 'firstname', 'lastname', 'email', 'university_id'])
            ->orderBy(request()->sort_by, request()->sort_order);

        if ($universityId) {
            $query->where('university_id', $universityId);
        }

        if ($universityFallback) {
            $query->where(function ($query) use ($universityFallback) {
                $query->where('university_fallback', 'LIKE', '%' . $universityFallback . '%');
                $query->orWhereHas('university', function ($query) use ($universityFallback) {
                    $query = $query->where('name', 'LIKE', '%' . $universityFallback . '%');
                });
            });
        }

        if ($search != "") {
            $query->where(function ($query) use ($search) {
                $searchColumns = ['firstname', 'lastname', 'email'];
                foreach ($searchColumns as $column) {
                    $query = $query->orWhere($column, 'LIKE', '%' . $search . '%');
                }
            });
        }

        return $query->paginate(request()->per_page);
    }

    /**
     * Show the authenticated user
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function showSelf(User $user)
    {
        $model = User
            ::where('id', auth()->user()->id)
            ->with([
                'permissions' => function ($query) {
                    $query->select(['id', 'user_id', 'conference_id', 'role_id', 'state_id', 'enrollment_form_id', 'lottery_position']);
                    $query->orderBy('created_at', 'desc');
                    $query->with([
                        'role:id,name,description',
                        'state:id,name,description',
                        'enrollmentForm:id,body',
                        'conference:id,key',
                    ]);
                },
                'timezone',
                'locale',
                'avatar'
            ])
            ->first([
                'id',
                'firstname',
                'lastname',
                'timezone_id',
                'locale_id',
            ]);

        // Now we remove some unneeded attributes
        $model->permissions->transform(function ($permission) {
            // If the user is a waitlisted SV, we need to calculate
            // the waitlist position and append it
            if (
                $permission->role_id == Role::byName('sv')->id
                && $permission->state_id == State::byName('waitlisted')->id
            ) {
                $permission->waitlist_position = $permission->updateWaitlistPosition();
            }
            return collect($permission)->except(['conference_id', 'enrollment_form_id', 'user_id', 'lottery_position']);
        });
        $collection = collect($model);

        return $collection->except(['timezone_id', 'locale_id']);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user = User::where('id', $user->id)
            ->with([
                'avatar',
                'languages',
                'permissions' => function ($query) {
                    $query->select([
                        'id', 'user_id', 'conference_id',
                        'enrollment_form_id', 'state_id',
                        'role_id'
                    ]);
                    $query->with([
                        'conference:id,key,name',
                        'conference.artwork:owner_id,web_path',
                        'role:id,name,description',
                        'state:id,name,description',
                        'enrollmentForm'
                    ]);
                    $query->orderBy('created_at', 'DESC');
                },
                'locale',
                'timezone',
                'university',
                'city'
            ])
            ->first();

        $user->location = $user->city->location();

        return collect($user)->except([
            'email_verified_at', 'created_at',
            'updated_at', 'city_id',
            'university_id'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {

        $data = $request->only(
            'firstname',
            'lastname',
            'email',
            'timezone_id',
            'date_format',
            'time_format',
            'time_sec_format',
            'timezone_id',
            'locale_id',
            'degree_id',
            'shirt_id',
            'past_conferences',
            'past_conferences_sv',
            'password'
        );

        if (isset($data["password"])) {
            // change password
            $data['password'] = Hash::make($data['password']);
        }

        // Prepare city
        if (isset($request->location["city"])) {
            $data['city_id'] = $request->location["city"]["id"];
        }

        // Prepare university
        if (isset($request->university["id"])) {
            $data['university_id'] = $request->university["id"];
            $data['university_fallback'] = null;
        } else if (isset($request->university["name"])) {
            $data['university_fallback'] = $request->university["name"];
            $data['university_id'] = null;
        }

        $user->update($data);

        // Update languages
        if (isset($request->languages)) {
            $existingLanguages = $user->languages->keyBy('id')->keys();
            $updatedLanguages = collect($request->languages)->keyBy('id')->keys();

            foreach ($existingLanguages as $language) {
                if ($updatedLanguages->search($language) === false) {
                    // has been removed
                    $user->languages()->detach($language);
                };
            }

            foreach ($updatedLanguages as $language) {
                if ($existingLanguages->search($language) === false) {
                    // has been added
                    $user->languages()->attach($language);
                };
            }
        }

        return ["result" => $user->loadMissing([
            'avatar', 'permissions',
            'permissions.conference.artwork',
            'permissions.conference', 'permissions.role',
            'permissions.state'
        ]), "message" => "User updated"];
    }

    /** 
     * Return all bids of a user of a given conference
     * 
     * @param  \App\User  $user
     * @param \App\Conference $conference
     * @return \Illuminate\Http\Response
     */
    public function bidsForConference(User $user, Conference $conference)
    {
        $bids = Bid
            ::where('user_id', $user->id)
            ->whereHas('task', function ($query) use ($conference) {
                $query->where('conference_id', $conference->id);
            })
            ->with([
                'task:id,name,start_at,end_at,hours,date',
                'state:id,name,description'
            ])
            ->get(['id', 'task_id', 'state_id', 'preference', 'created_at', 'updated_at', 'preference']);

        return $bids;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // Delete assignments, bids
        Assignment::where('user_id', $user->id)->delete();
        Bid::where('user_id', $user->id)->delete();
        if ($user->avatar) $user->avatar->delete();
        foreach ($user->permissions as $permission) {
            if ($permission->enrollmentForm) {
                $permission->enrollmentForm->delete();
            }
            $permission->delete();
        }

        $result = $user->delete();
        return ["success" => $result, "message" => "User deleted"];
    }


    // Blade view routes (web route endpoints)

    /**
     * Render the user index form
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function showIndex()
    {
        return view('user.index');
    }

    /**
     * Render the user edit form
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function showEdit(User $user)
    {
        return view('user.edit', compact('user'));
    }
}