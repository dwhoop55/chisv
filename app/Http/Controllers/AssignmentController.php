<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Http\Requests\AssignmentRequest;
use App\Task;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
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
    public function store(AssignmentRequest $request)
    {
        $data = $request->only('user_id', 'task_id');
        $data['hours'] = Task::find($data['task_id'])->hours;
        $assignment = new Assignment($data);
        $assignment->save();
        $assignment->refresh();
        return ["result" => true, "message" => "Assignment created"];
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Assignment  $assignment
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Assignment $assignment)
    // {
    //     //
    // }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function update(AssignmentRequest $request, Assignment $assignment)
    {
        $data = $request->only(['hours', 'state_id']);
        $assignment->update($data);
        $assignment->refresh();
        return ["result" => $assignment, "message" => "Assignment updated"];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assignment $assignment)
    {
        $assignment->delete();
        return ["result" => true, "message" => "Assignment removed"];
    }
}