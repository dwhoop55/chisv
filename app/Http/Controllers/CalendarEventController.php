<?php

namespace App\Http\Controllers;

use App\Assignment;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * @authenticated
 * @group Calendar
 */
class CalendarEventController extends Controller
{
    /**
     * Get all calendar events
     * 
     * @queryParam start string required the start time of events Example: 2019-01-01
     * @queryParam end string required the end time of events Example: 2024-01-01
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $start = $request->start ? Carbon::create($request->start) : null;
        $end = $request->end ? Carbon::create($request->end) : null;
        $user = auth()->user();

        abort_if(!$start || !$end || !$user, 400, "You need to provide start and end!");

        $assignments = Assignment
            ::where('user_id', $user->id)
            ->whereHas('task', function ($query) use ($start, $end) {
                $query->whereBetween('date', [$start, $end]);
            })
            ->with([
                'task:id,name,location,description,date,start_at,end_at,conference_id',
                'state:id,name,description',
                'task.conference:id,timezone_id',
                'task.conference.timezone',
            ])
            ->get(['id', 'user_id', 'task_id', 'hours', 'state_id']);

        $assignments = $assignments->map(function ($assignment) {
            $start = $assignment->task->date;
            $start->setTimeFrom(Carbon::create($assignment->task->start_at));
            $end = $assignment->task->date;
            $end->setTimeFrom(Carbon::create($assignment->task->end_at));
            return [
                "title" => $assignment->task->name,
                "description" => $assignment->task->description,
                "location" => $assignment->task->location,
                "timezone" => $assignment->task->conference->timezone->name,
                "start" => $start->toDateTimeString(),
                "end" => $end->toDateTimeString(),
                "assignment" => [
                    'state' => $assignment->state->only(['name', 'description']),
                    'hours' => $assignment->hours,
                ],
            ];
        });

        return ["assignments" => $assignments];
    }
}
