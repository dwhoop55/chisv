<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Http\Requests\AssignmentRequest;
use App\State;
use App\Task;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Assignment::class);
    }

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

        // Mark bid as successful
        $bid = $assignment->bid();
        if ($bid) {
            $bid->state()->associate(State::byName('successful', 'App\Bid'))->save();
        }

        return ["result" => true, "message" => "Assignment created"];
    }

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
        if (isset($data['hours']) && !is_numeric($data['hours'])) {
            abort(400, "Hours have to be int (1,2,3) or float (0.25,3.75)!");
        }

        $assignment->update($data);
        $assignment = $assignment->fresh(['state']);
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
        // Mark bid as placed again
        $bid = $assignment->bid();
        if ($bid) {
            $bid->state()->associate(State::byName('placed', 'App\Bid'))->save();
        }

        $assignment->delete();
        return ["result" => true, "message" => "Assignment removed"];
    }
}