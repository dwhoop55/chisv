<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionCreateRequest;
use App\Permission;
use Illuminate\Http\Request;
use App\Http\Requests\PermissionRequest;
use App\Http\Requests\PermissionUpdateRequest;
use App\State;
use Illuminate\Support\Facades\Log;

/** 
 * @authenticated
 * @group Permission
 */
class PermissionController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Permission::class);
    }

    /**
     * Create a new permission
     *      
     * @bodyParam user_id int required The user's id Example: 1
     * @bodyParam role_id int required The role of the permission by id Example: 2
     * @bodyParam conference_id int The conference id to bind the permission to Example: 1
     * @bodyParam state_id int The permission's state Example: 11
     *
     * @response 200 {
     * "result": true,"message": "Permission granted!"
     * }
     * 
     * @response 400 {
     * "message": "Permission already exists"
     * }
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionCreateRequest $request)
    {
        $permission = new Permission(
            request([
                'user_id',
                'role_id',
                'conference_id',
                'state_id',
            ])
        );
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

        return response()->noContent(201);
    }

    /**
     * Delete a new permission
     *      
     * @urlParam permission required The permission's id Example: 2
     * 
     * @response 204
     * @response 404 {
     * "message": "No query results for model [App\\Permission] 1"
     * }
     * 
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return response()->noContent();
    }

    /**
     * Update a permission
     *      
     * @urlParam permission required The permission's id Example: 2
     * @bodyParam role_id int required The role of the permission by id Example: 2
     * @bodyParam state_id int The permission's state Example: 11
     * 
     * @response 204
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionUpdateRequest $request, Permission $permission)
    {
        // $oldPermission = $permission;
        // $updatedPermission = $permission;
        // $updatedPermission->fill($request->only(['state_id']));
        // dd($updatedPermission->toArray());
        $waitlistedId = State::byName('waitlisted', 'App\User')->id;
        $enrolledId = State::byName('enrolled', 'App\User')->id;
        $acceptedId = State::byName('accepted', 'App\User')->id;
        $droppedId = State::byName('dropped', 'App\User')->id;

        $newStateId = $request->input('state_id');
        $user = auth()->user();

        // Last check: abort if the policy denies update of
        // this specific permission for the given user
        abort_unless(
            $user->can(
                'createThis',
                new Permission([
                    'conference' => $permission->conference,
                    'state_id' => $newStateId
                ])
            ),
            403,
            'You don\'t have permission to update the permission in this way'
        );

        // Make sure to adjust lottery_position
        if ($permission->state_id != $waitlistedId && $newStateId == $waitlistedId) {
            // -> changed to waitlisted
            // User was put onto the waitlist. Assign new (max) lottery_position
            // may return null
            $max = $permission->conference->permissions->max('lottery_position');
            // null + 1 = 1
            $permission->lottery_position = $max + 1;
        } else if (
            ($permission->state_id != $enrolledId && $newStateId == $enrolledId)
            || ($permission->state_id != $acceptedId && $newStateId == $acceptedId)
            || ($permission->state_id != $droppedId && $newStateId == $droppedId)
        ) {
            // -> changed to enrolled
            // -> changed to accepted
            // -> changed to dropped
            $permission->lottery_position = null;
        }

        $permission->state_id = $newStateId;

        $permission->saveOrFail();
        $permission->refresh();
        $permission->updateWaitlistPosition();

        return $permission->only(['id', 'lottery_position', 'waitlist_position']);
    }
}