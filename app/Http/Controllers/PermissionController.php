<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;
use App\Http\Requests\PermissionRequest;

class PermissionController extends Controller
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
        $this->authorizeResource(Permission::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $permission = new Permission($request->all());
        $user = auth()->user();

        // Last check: abort if the policy denies creation of
        // this specific permission for the given user
        abort_unless($user->can('createThis', $permission), 403, 'You don\'t have permission to create this permission');

        // Now try to save - when the permission already exists this will fail
        // return a message then
        try {
            $result = $permission->save();
        } catch (\Throwable $th) {
            abort(400, 'Permission already exists');
        }
        return ["result" => $result, "message" => "Permission granted!"];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $result = $permission->delete();
        return ['success' => $result, "message" => "Permission revoked"];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, Permission $permission)
    {
        $updatedPermission = new Permission($request->all());
        $user = auth()->user();

        // Last check: abort if the policy denies update of
        // this specific permission for the given user
        abort_unless($user->can('createThis', $updatedPermission), 403, 'You don\'t have permission to update the permission in this way');

        // Now try to save - when the permission already exists this will fail
        // return a message then
        try {
            $oldPermission = Permission::find($request->get('id'));
            $result = $oldPermission->update($request->all(['role_id', 'conference_id', 'state_id']));
        } catch (\Throwable $th) {
            abort(400, 'Permission already exists');
        }
        return ["result" => $result, "message" => "Permission updated!"];
    }

    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index()
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Permission  $permission
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Permission $permission)
    // {
    //     //
    // }


}