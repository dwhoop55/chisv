<?php

namespace App\Http\Controllers;

use App\Bid;
use App\Conference;
use App\Http\Requests\BidCreateRequest;
use App\Http\Requests\BidUpdateRequest;
use App\Http\Requests\MultiBidRequest;
use App\State;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
     * Create new bids by params
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function multiBid(MultiBidRequest $request)
    {
        $user = auth()->user();
        $conference = Conference::findOrFail($request->conference_id);
        abort_unless($user->isSv($conference, State::byName('accepted')), 403, "You are not an SV with state accepted for this conference");

        $search = strlen($request->search) > 0 ? $request->search : null;
        $preference = request()->preference;

        $days = collect(request()->days);
        abort_unless($days, 400, "Invalid days parameter. Requires JSON array");

        $priorities = collect(request()->priorities);
        $onlyOwnTasks = false;
        $perPage = null;
        $paginate = false;
        $sortBy = null;
        $sortOrder = null;

        $tasks = (app('App\Http\Controllers\ConferenceController')->prepareTasks(
            $conference,
            auth()->user(),
            $search,
            $days,
            $priorities,
            $onlyOwnTasks,
            $sortBy,
            $sortOrder,
            $perPage,
            $paginate
        ));

        $count = [
            'created' => 0,
            'updated' => 0,
            'untouched' => 0,
            'revoked' => 0,
        ];

        $bidsToCreate = collect();
        $bidsToUpdate = collect();
        $bidsToRevoke = collect();

        foreach ($tasks as $task) {
            if ($preference !== null) {
                // set/update a preference
                if (isset($task['can_create_bid']) && $task['can_create_bid']) {
                    // create new bid
                    $bid = [
                        'user_id' => $user->id,
                        'task_id' => $task['id'],
                        'preference' => $preference,
                        'user_created' => true,
                    ];
                    $bidsToCreate->push($bid);
                    $count['created'] += 1;
                } else if (isset($task['own_bid']) && $task['own_bid']['can_update']) {
                    // update existing bid
                    if ($task['own_bid']['preference'] !== $preference) {
                        $bidsToUpdate->push($task['own_bid']['id']);
                    } else {
                        $count['untouched'] += 1;
                    }
                }
            } else if ($preference === null && isset($task['own_bid']) && $task['own_bid']['can_update']) {
                $bidsToRevoke->push($task['own_bid']['id']);;
            }
        }

        DB::table('bids')->insert($bidsToCreate->toArray());
        $count['updated'] = DB::table('bids')->whereIn('id', $bidsToUpdate)->update(['preference' => $preference]);
        $count['revoked'] = DB::table('bids')->whereIn('id', $bidsToRevoke)->delete();

        return $count;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\BidCreateRequest  $request
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
            'preference' => $request['preference'],
            'user_created' => true,
        ]);

        $bid->save();
        $bid = $bid->fresh('state')->only('id', 'preference', 'state');
        // A newly created bid is always updateable
        // Furthermore we reach this code here only when the gate from
        // above 'createForTask' allow. It uses the same code to check
        // authorization - 'update' only checks for assignments
        // It's true that an assignment could already be create at this
        // point - but that's unlikely. This could only happen when the
        // SV loads the list of tasks and is then assigned a task by a
        // chair. SV clicking on a preference then would create a bid
        // for an already existing assignment. 
        $bid['can_update'] = true;
        $bid['state'] = $bid['state']->only(['id', 'name', 'description']);
        return ["result" => $bid, "message" => "Bid created"];
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

        $bid->update(['preference' => $data['preference'], 'user_created' => true]);
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
        if ($bid->delete()) {
            return ["result" => true, "message" => "Bid removed"];
        } else {
            return ["result" => false, "message" => "Bid could not be removed"];
        }
    }
}