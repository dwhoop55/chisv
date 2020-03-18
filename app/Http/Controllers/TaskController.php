<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Bid;
use App\Http\Requests\TaskCreateRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Task;

class TaskController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Task::class);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskCreateRequest $request)
    {
        $data = $request->only(
            'conference_id',
            'name',
            'location',
            'description',
            'date',
            'start_at',
            'end_at',
            'hours',
            'priority',
            'slots'
        );
        $task = new Task($data);
        $task->save();
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Task  $task
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Task $task)
    // {
    //     //
    // }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(TaskUpdateRequest $request, Task $task)
    {
        $data = $request->only(
            'name',
            'location',
            'description',
            'date',
            'start_at',
            'end_at',
            'hours',
            'priority',
            'slots'
        );
        $task->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        // Remove all bids if there are any
        $bidsCount = Bid
            ::where('task_id', $task->id)
            ->delete();

        // Remove all assignments if there are any
        $assignmentCount = Assignment
            ::where('task_id', $task->id)
            ->delete();


        if ($task->delete()) {
            return ["result" => true, "message" => "Task removed. $bidsCount/$assignmentCount associated bids/assignments have been deleted."];
        } else {
            return ["result" => false, "message" => "Task could not be removed"];
        }
    }
}