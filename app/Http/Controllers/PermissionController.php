<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;
use App\Http\Requests\PermissionRequest;
use App\State;

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
        $oldPermission = $permission;
        $updatedPermission = new Permission($request->all());
        $waitlistedId = State::byName('waitlisted', 'App\User')->id;
        $enrolledId = State::byName('enrolled', 'App\User')->id;
        $acceptedId = State::byName('accepted', 'App\User')->id;
        $droppedId = State::byName('dropped', 'App\User')->id;
        $user = auth()->user();

        // Last check: abort if the policy denies update of
        // this specific permission for the given user
        abort_unless($user->can('createThis', $updatedPermission), 403, 'You don\'t have permission to update the permission in this way');

        // Make sure to adjust lottery_position
        // -> Waitlist
        if ($oldPermission->state_id != $waitlistedId && $updatedPermission->state_id == $waitlistedId) {
            // -> Waitlist
            // User was put onto the waitlist. Assign new (max) lottery_position
            // may return null
            $max = $updatedPermission->conference->permissions->max('lottery_position');
            // null + 1 = 1
            $updatedPermission->lottery_position = $max + 1;
        } else if (
            ($oldPermission->state_id != $enrolledId && $updatedPermission->state_id == $enrolledId)
            || ($oldPermission->state_id != $acceptedId && $updatedPermission->state_id == $acceptedId)
            || ($oldPermission->state_id != $droppedId && $updatedPermission->state_id == $droppedId)
        ) {
            // -> Enrolled
            // -> Accepted
            // -> Dropped
            $updatedPermission->lottery_position = null;
        } else {
            $updatedPermission->lottery_position = $oldPermission->lottery_position;
        }

        $oldPermission->update($updatedPermission->only('conference_id', 'state_id', 'role_id', 'lottery_position'));
        $updatedPermission = $oldPermission->refresh();
        $updatedPermission->updateWaitlistPosition();

        return ["result" => $updatedPermission, "message" => "Permission updated!"];
    }
}