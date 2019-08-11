<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use App\Http\Resources\Roles;

class RoleController extends Controller
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
        $this->authorizeResource(Conference::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Ask the RolePolicy if index is allowed for that user
        $this->authorize('index', Role::class);

        $roles = Role::all()->filter(function ($role) {
            return auth()->user()->can('view', $role);
        });

        return new Roles($roles);
    }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Role  $role
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Role $role)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Role  $role
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, Role $role)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Role  $role
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Role $role)
    // {
    //     //
    // }
}