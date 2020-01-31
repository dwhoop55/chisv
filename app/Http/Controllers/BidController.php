<?php

namespace App\Http\Controllers;

use App\Bid;
use App\Http\Requests\BidCreateRequest;
use App\Http\Requests\BidUpdateRequest;
use App\Task;
use Illuminate\Http\Request;

class BidController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Bid::class);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BidCreateRequest $request)
    {
        $user = auth()->user();
        $data = $request->only('task_id', 'preference');

        // Check if the user can create a bid
        // for the task
        $task = Task::find($data['task_id']);
        abort_unless($user->can('createForTask', ['App\Bid', $task]), 403, 'You are not authorized to create a bid for this task');


        $bid = new Bid([
            'user_id' => $user->id,
            'task_id' => $task->id,
            'preference' => $request['preference']
        ]);

        $bid->save();
        $userCanUpdate = auth()->user()->can('update', $bid);
        $bid = $bid->fresh('state')->only('id', 'preference', 'state');
        $bid['can_update'] = $userCanUpdate;
        $bid['state'] = $bid['state']->only(['id', 'name', 'description']);
        return ["result" => $bid, "message" => "Bid created"];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bid  $bid
     * @return \Illuminate\Http\Response
     */
    public function show(Bid $bid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bid  $bid
     * @return \Illuminate\Http\Response
     */
    public function update(BidUpdateRequest $request, Bid $bid)
    {
        $data = $request->only('id', 'preference');

        // Check if the user can update this bid
        $userCanUpdate = auth()->user()->can('update', $bid);
        abort_unless($userCanUpdate, 403, 'You are not authorized to update this bid');

        $bid->update(['preference' => $data['preference']]);
        $bid = $bid->fresh('state')->only('id', 'preference', 'state');
        $bid['can_update'] = $userCanUpdate;
        $bid['state'] = $bid['state']->only(['id', 'name', 'description']);

        return ["result" => $bid, "message" => "Bid updated"];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bid  $bid
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bid $bid)
    {
        //
    }
}