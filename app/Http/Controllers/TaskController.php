<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Bid;
use App\Http\Requests\TaskCreateRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Task;

/**
 * @authenticated
 * @group Task
 */
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

    /**
     * Create a new task
     * 
     * @bodyParam conference_id int required Create task for this conference by id Example: 1
     * @bodyParam name string required Task's name Example: SVing Task
     * @bodyParam location string required Task's location Example: Main Hall
     * @bodyParam description string required Task's description Example: Nothing to do here
     * @bodyParam date string required Task's date Example: 2020-07-01
     * @bodyParam start_at string required Task's start time Example: 12:00:00
     * @bodyParam end_at string required Task's end time Example: 15:00:00
     * @bodyParam hours int required Task's accounted hours Example: 3
     * @bodyParam priority int required Task's priority Example: 2
     * @bodyParam slots int required Max allowed SVs Example: 5
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
        return $task->refresh();
    }

    /**
     * Update a task
     * 
     * @urlParam task required Task's id Example: 1
     * @bodyParam conference_id int required Bound to this conference by id Example: 1
     * @bodyParam name string required Task's name Example: SVing Task
     * @bodyParam location string required Task's location Example: Main Hall
     * @bodyParam description string required Task's description Example: Nothing to do here
     * @bodyParam date string required Task's date Example: 2020-07-01
     * @bodyParam start_at string required Task's start time Example: 12:00:00
     * @bodyParam end_at string required Task's end time Example: 15:00:00
     * @bodyParam hours int required Task's accounted hours Example: 3
     * @bodyParam priority int required Task's priority Example: 2
     * @bodyParam slots int required Max allowed SVs Example: 5
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
        return $task->refresh();
    }

    /**
     * Delete a task
     * 
     * @urlParam task required Task's id Example: 1
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

        // Remove all notes to this task's assignments
        $notesCount = 0;
        foreach ($task->assignments as $assignment) {
            $notesCount += $assignment->notes->count();
            $assignment->notes()->delete();
        }

        // Remove all assignments if there are any
        $assignmentCount = Assignment
            ::where('task_id', $task->id)
            ->delete();


        if ($task->delete()) {
            return ["result" => true, "message" => "Task removed. $bidsCount/$assignmentCount/$notesCount associated bids/assignments/notes have been deleted."];
        } else {
            return ["result" => false, "message" => "Task could not be removed"];
        }
    }
}
