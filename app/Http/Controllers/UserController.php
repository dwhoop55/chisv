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
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Hash;

/**
 * @authenticated
 * @group User
 */
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
     * Get all users
     * 
     * @queryParam university_id int Limit to university by id Example: 4044
     * @queryParam university_fallback string Limit to university by name Example: "Aachen"
     * @queryParam search string Search users by name Example: "Admin"
     * @queryParam sort_by string Sort by column Example: lastname
     * @queryParam sort_order string Sort order Example: asc
     * @queryParam per_page int Results per page Example: 2
     * @queryParam page int Show page Example: 1
     * 
     * @response {
     * "current_page":1,"data":[{"id":1,"firstname":"ADMIN Milton","lastname":"Waddams","email":"admin@chisv.org","university_id":"4011","university_fallback":null,"university":{"id":4011,"name":"Rajasthan Technical University"},"permissions":[{"user_id":1,"conference_id":null,"role":{"id":1,"name":"admin","description":"Can do anything"},"state":null,"conference":null},{"user_id":1,"conference_id":1,"role":{"id":10,"name":"sv","description":"Is associated for conferences as SV"},"state":{"id":11,"name":"enrolled","description":"Waiting to be accepted, waitlisted or dropped"},"conference":{"id":1,"name":"CHI 2020","key":"chi20"}}]}],"first_page_url":"http:\/\/localhost:8000\/api\/v1\/user?page=1","from":1,"last_page":1,"last_page_url":"http:\/\/localhost:8000\/api\/v1\/user?page=1","next_page_url":null,"path":"http:\/\/localhost:8000\/api\/v1\/user","per_page":"25","prev_page_url":null,"to":1,"total":1
     * }
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
            ->select(['id', 'firstname', 'lastname', 'email', 'university_id', 'university_fallback'])
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
     * Get the authenticated user
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function showSelf(User $user)
    {
        abort_if(!$user->id && !auth()->id(), 400, "No user specified");

        $id = $user->id ?? auth()->id();
        $model = User
            ::where('id', $id)
            ->with([
                'permissions' => function ($query) {
                    $query->select(['id', 'user_id', 'conference_id', 'role_id', 'state_id', 'enrollment_form_id', 'lottery_position']);
                    $query->orderBy('created_at', 'desc');
                    $query->with([
                        'role:id,name,description',
                        'state:id,name,description',
                        'enrollmentForm:id,name,body',
                        'conference:id,key',
                    ]);
                },
                'locale',
                'avatar'
            ])
            ->first([
                'id',
                'firstname',
                'lastname',
                'past_conferences',
                'past_conferences_sv',
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

        return $collection->except(['locale_id']);
    }


    /**
     * Get a user
     * 
     * @urlParam user The user's id Example: 1
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
                        'conference:id,key,name,state_id',
                        'conference.state:id,name,description',
                        'conference.artwork:owner_id,web_path',
                        'role:id,name,description',
                        'state:id,name,description',
                        'enrollmentForm:id,name,body',
                        'user:id',
                    ]);
                    $query->orderBy('created_at', 'DESC');
                },
                'locale',
                'university',
                'city'
            ])
            ->first();

        $user->location = [
            "country" => $user->country ?? null,
            "region" => $user->region ?? null,
            "city" => $user->city ?? null,
        ];

        return collect($user)->except([
            'email_verified_at', 'created_at',
            'updated_at', 'city_id',
            'university_id'
        ]);
    }

    /**
     * Update a user
     * 
     * @urlParam user int required The user's id Example: 1
     * @bodyParam firstname string required The user's first name Example: Jacob
     * @bodyParam lastname string required The user's last name Example: Smith
     * @bodyParam email string required The user's email Example: jacob@example.com
     * @bodyParam languages array<[Language](#get-all-languages-matching-a-pattern)> An array of languages
     * @bodyParam languages.*.id int required A [language's](#get-all-languages-matching-a-pattern) id Example: 23
     * @bodyParam location [Location](#get-all-locations-for-a-country-by-city-name) required The users location by city name
     * @bodyParam location.country.id int required The location's country id Example: 82
     * @bodyParam location.country.name string The location's country name Example: Germany
     * @bodyParam location.region.id int The location's region id Example: 1268
     * @bodyParam location.region.name string The location's region name Example: Nordrhein-Westfalen
     * @bodyParam location.city.id int The location's city id Example: 12850
     * @bodyParam location.city.name string The location's city name Example: Aachen
     * @bodyParam university.id int The [university's](#get-all-universities-matching-a-pattern) id Example: 4044
     * @bodyParam university.name string The fallback university's name if no id used (see above) Example: RWTH Aachen
     * @bodyParam degree_id int required The user's [degree](#get-all-degrees) Example: 2
     * @bodyParam shirt_id int required The user's [shirt](#get-all-t-shirts) Example: 3
     * @bodyParam locale_id int required The user's [locale](#get-all-locales) Example: 51
     * @bodyParam past_conferences array<string> The user's past attended conferences as array
     * @bodyParam past_conferences.* string A user's past attended conference Example: CHI 2019
     * @bodyParam past_conferences_sv array<string> The user's past attended conferences as SV as array
     * @bodyParam past_conferences_sv.* string A user's past attended conference as SV Example: CHI 2019
     * @bodyParam password string The user's password Example: secret
     * @bodyParam password_confirmation string The user's password Example: secret
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

        // Prepare location
        if (isset($request->location["country"]["id"])) {
            $data['country_id'] = $request->location["country"]["id"];
        }
        $data['region_id'] = $request->location["region"]["id"] ?? null;
        $data['city_id'] = $request->location["city"]["id"] ?? null;

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

        // $user->location = [
        //     "country" => $user->country ?? null,
        //     "region" => $user->region ?? null,
        //     "city" => $user->city ?? null,
        // ];

        return [
            "result" => $this->show($user), "message" => "User updated"
        ];
    }

    /** 
     * Get all notifications for a user of a given conference
     * 
     * @urlParam user required The user's id Example: 1
     * @urlParam conference required The conference's key Example: chi20
     * 
     * @param  \App\User  $user
     * @param  \App\Conference $conference
     * @return \Illuminate\Http\Response
     */
    public function notificationsForConference(User $user, Conference $conference)
    {
        // We limit to the last 20 notifications since they can be huge
        $allNotifications = $user->notifications()->orderBy('created_at')->get();
        $filtered = $allNotifications
            ->filter(function ($notification) use ($conference) {
                if (
                    isset($notification->data['conference']) &&
                    $notification->data['conference']['id'] == $conference->id
                ) {
                    return true;
                } else {
                    return false;
                };
            })
            ->map(function ($notification) {
                $s = collect($notification)->except(['notifiable_id', 'notifiable_type', 'updated_at']);
                $s['data'] = collect($s['data'])->except(['conference']);
                return $s;
            })
            ->values();

        return ["total" => $filtered->count(), 'notifications' => $filtered->take(20)];
    }

    /** 
     * Get all bids for a user of a given conference
     * 
     * @urlParam user required The user's id Example: 1
     * @urlParam conference required The conference's key Example: chi20
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
            ->get(['id', 'task_id', 'state_id', 'preference', 'preference']);

        return $bids;
    }

    /** 
     * Delete a user
     * 
     * @urlParam user required The user's id Example: 2
     * 
     * @response 200 {
     * "success": true,"message": "User deleted"
     * }
     * 
     * @response 403 {
     * "message": "This action is unauthorized."
     * }
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
}