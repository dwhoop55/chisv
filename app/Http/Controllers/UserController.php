<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Degree;
use App\Shirt;
use App\Http\Resources\Users;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // This will only authorize CRUD, not the index
        // we authorize it manually
        $this->authorizeResource(User::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Ask the UserPolicy if index is allowed for that user
        $this->authorize('index', User::class);

        // First we setup the query whith common arguments
        $userQuery = User::with('degree', 'shirt', 'university', 'permissions.conference', 'permissions.role')
            ->orderBy(request()->sort_by, request()->sort_order);

        // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        // Why not simply using the Gate to allow for view?
        // The answer is: You would have to fetch all users first,
        // then you'll have a collection. You can then loop through
        // the collection (filter) only the users the can be view'ed
        // BUT then you can no longer paginate on the query
        // Paginate is not available (stock) for collections,
        // but we account for really large userbase. I've tested
        // this code with over 1000 users and it yields enough performance
        // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

        // Now we need to distunguish beween the roles and limit
        // the users we will query for if the authUser is anything
        // but an admin
        if (auth()->user()->isChair() || auth()->user()->isCaptain()) {
            // For chair or captain we need to
            // return only the users that are
            // associated with the conferences
            // the user manages
            $userIds = collect([]);
            $conferences = auth()->user()->conferencesAsChairOrCaptain();
            foreach ($conferences as $conference) {
                $userIds = $userIds->merge($conference->users->pluck('id'));
            }

            // Now we have an array with all user id
            // the the chair or captain can see
            // Now drop duplicates (when people are at two conferences
            // the chair/captain manages the person should only be shown
            // once)
            $userIds = $userIds->unique()->values();

            // Now we can finally restrict the query
            // to only return users with a specific id
            $userQuery = $userQuery->whereIn('id', $userIds);
        }

        // Process the search query if there is one
        // Note: We are adding an AND (1 OR 2 OR 3 OR ..)
        if (request()->search_string != "") {
            $userQuery->where(function ($query) {
                $searchColumns = ['firstname', 'lastname', 'email'];
                foreach ($searchColumns as $column) {
                    $query = $query->orWhere($column, 'LIKE', '%' . request()->search_string . '%');
                }
            });
        }
        return new Users($userQuery->paginate(request()->per_page));
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
                'degree',
                'languages',
                'permissions' => function ($query) {
                    $query->orderBy('created_at', 'DESC');
                },
                'university',
                'city'
            ])
            ->first();

        $user->location = $user->city->location();
        return $user;
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

        if (isset($request->location["city"])) $data['city_id'] = $request->location["city"]["id"];
        if (isset($request->university["id"])) $data['university_id'] = $request->university["id"];

        $result = $user->update($data);

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

        return ["success" => $result, "message" => "User updated"];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
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