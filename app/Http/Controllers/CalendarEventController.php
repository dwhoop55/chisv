<?php

namespace App\Http\Controllers;

use App\Assignment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalendarEventController extends Controller
{
    /**
     * Display a listing of the resource.
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
                'task:id,name,location,description,date,start_at,end_at,priority,hours',
                'state:id,name,description',
            ])
            ->get(['id', 'user_id', 'task_id', 'hours', 'state_id']);

        return ["assignments" => $assignments];
    }
}