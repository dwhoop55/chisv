<?php

namespace App\Http\Controllers;

use App\Conference;
use App\Role;
use App\Shirt;
use App\State;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Conference $conference, String $name)
    {
        switch ($name) {
            case 'shirts':
                return $this->shirtsReport($conference);
                break;
            case 'svs':
                return $this->svsReport($conference);
                break;
            case 'tasks':
                return $this->tasksReport($conference);
                break;

            default:
                abort(404, "No report for $name at " . $conference->key);
                break;
        }
    }

    public function tasksReport($conference)
    {

        $doneState = State::byName('done', 'App\Assignment');

        $columns = collect([
            $this->buildColumn('day', 'Day'),
            $this->buildColumn('task_count', '# Tasks'),
            $this->buildColumn('task_hours', 'Task hours', true),
            $this->buildColumn('assignment_count', '# Assignments', true),
            $this->buildColumn('assignment_hours', 'Assignment hurs', true),
            $this->buildColumn('assignment_hours_done', 'Assignment hours done', true),
            $this->buildColumn('assignment_hours_not_done', 'Assignment hours not done', true),
        ]);


        $data = $conference
            ->tasks()
            ->with([
                'assignments:id,hours,state_id,task_id',
                'bids:id,task_id',
            ])
            ->get()
            ->map(function ($task) {
                $task->date_int = $task->date->timestamp;
                return $task;
            });

        $data = $data->groupBy('date_int');
        $data->transform(function ($day) use ($doneState) {
            $assignmentsCount = $day->sum(function ($task) {
                return $task->assignments->count();
            });
            $assignmentsHours = $day->sum(function ($task) {
                return $task->assignments->sum('hours');
            });
            $assignmentsHoursDone = $day->sum(function ($task) use ($doneState) {
                return $task->assignments
                    ->where('state_id', $doneState->id)
                    ->sum('hours');
            });

            return [
                "day" => $day->first()->date->toDateString(),
                "task_count" => $day->count(),
                "task_hours" => $day->sum('hours'),
                "assignment_count" => $assignmentsCount,
                "assignment_hours" => $assignmentsHours,
                "assignment_hours_done" => $assignmentsHoursDone,
                "assignment_hours_not_done" => $assignmentsHours - $assignmentsHoursDone,
            ];
        });

        return ["columns" => $columns, "data" => $data->values(), "updated" => Carbon::create('now')];
    }

    public function svsReport($conference)
    {
        $doneState = State::byName('done', 'App\Assignment');

        $columns = collect([
            $this->buildColumn('firstname', 'Firstname'),
            $this->buildColumn('lastname', 'Lastname'),
            $this->buildColumn('hours_done', 'Hours Done', true),
            $this->buildColumn('assignments_count', 'Number of assignments', true),
            $this->buildColumn('bids_zero', '# Bid 0', true),
            $this->buildColumn('bids_one', '# Bid 1 (incl. default bid)', true),
            $this->buildColumn('bids_two', '# Bid 2', true),
            $this->buildColumn('bids_three', '# Bid 3', true),
            $this->buildColumn('bids_higher_two', '# Bids >= 2', true),
            $this->buildColumn('bids_total', '# Bids', true),
        ]);

        $data = $conference
            ->users(Role::byName('sv'))
            ->with([
                'assignments' => function ($query) use ($doneState, $conference) {
                    $query->where('state_id', $doneState->id);
                    $query->whereHas('task', function ($query) use ($conference) {
                        $query->where('conference_id', $conference->id);
                    });
                },
                'bids' => function ($query) use ($conference) {
                    $query->whereHas('task', function ($query) use ($conference) {
                        $query->where('conference_id', $conference->id);
                    });
                }
            ])
            ->get()
            ->map(function ($sv) use ($doneState) {
                $hoursDone = round($sv->assignments->sum('hours'), 2);
                $assignmentsCount = $sv->assignments->count();

                $bidsZero = $sv->bids->where('preference', 0)->count();
                $bidsOne = $sv->bids->where('preference', 1)->count();
                // We need to add the assignments which come from the default bid of 1
                $sv->assignments->each(function ($assignment) use (&$bidsOne, $sv) {
                    $bid = $sv->bids->where('task_id', $assignment->task_id)->first();
                    if (!$bid) {
                        // If there is no bid the assignment was done by the default bid 1 or manually
                        $bidsOne++;
                    }
                });
                $bidsTwo = $sv->bids->where('preference', 2)->count();
                $bidsThree = $sv->bids->where('preference', 3)->count();
                $bidsHigherTwo = $sv->bids->where('preference', '>=', 2)->count();


                return [
                    'firstname' => $sv->firstname,
                    'lastname' => $sv->lastname,
                    'hours_done' => $hoursDone,
                    'assignments_count' => $assignmentsCount,
                    'bids_zero' => $bidsZero,
                    'bids_one' => $bidsOne,
                    'bids_two' => $bidsTwo,
                    'bids_three' => $bidsThree,
                    'bids_higher_two' => $bidsHigherTwo,
                    'bids_total' => $bidsZero + $bidsOne + $bidsTwo + $bidsThree,
                ];
            });

        return ["columns" => $columns, "data" => $data, "updated" => Carbon::create('now')];
    }

    public function shirtsReport($conference)
    {
        $columns = collect([
            $this->buildColumn('cut', 'Cut'),
            $this->buildColumn('size', 'Size'),
            $this->buildColumn('count', 'Count', true),
        ]);
        $data = Shirt::all()->push(new Shirt(["id" => null, "cut" => "unknown", "size" => "unknown"]));
        $shirts = $conference
            // We get all the users for this conference
            ->users(Role::byName('sv'))
            // With their shirt attribute
            ->with(['shirt'])
            // And we only need these columns on the user object
            ->get(['users.id', 'users.shirt_id'])
            // Just get the shirt from the user and replace the user by the shirt
            ->map(function ($user) {
                return $user->shirt;
            });

        // Now we count the shirts
        $data->transform(function ($shirt) use ($shirts) {
            $count = $shirts->where('id', $shirt->id)->count();
            $shirt->count = $count;
            return $shirt;
        });

        return ["columns" => $columns, "data" => $data, "updated" => Carbon::create('now')];
    }

    public function buildColumn(String $key, String $label, bool $numeric = false, String $width = null, bool $sortable = true, bool $searchable = true)
    {
        return [
            'field' => $key,
            'label' => $label,
            'width' => $width,
            'numeric' => $numeric,
            'sortable' => $sortable,
            'searchable' => $searchable
        ];
    }
}