<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\Users;
use Illuminate\Http\JsonResponse;

class UserApiController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
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
        return ["result" => true, "error" => null];
    }
}