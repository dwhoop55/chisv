<?php

namespace App\Http\Controllers;

use App\Conference;
use App\Country;
use App\Language;
use App\Role;
use App\Shirt;
use App\State;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Conference $conference, String $name)
    {
        switch ($name) {
            case 'sv_accepted_minutes_ago':
                return $this->svAcceptedMinutesAgo($conference, request('number', 60));
                break;
            case 'sv_shirts':
                return $this->shirtsReport($conference);
                break;
            case 'sv_hours':
                return $this->svHoursReport($conference);
                break;
            case 'sv_bids':
                return $this->svBidsReport($conference);
                break;
            case 'sv_detail':
                return $this->svDetailReport($conference);
                break;
            case 'sv_demographics_country':
                return $this->svDemoReport($conference, 'country');
                break;
            case 'sv_demographics_language':
                return $this->svDemoReport($conference, 'language');
                break;
            case 'task_overview':
                return $this->taskOverviewReport($conference);
                break;
            case 'tasks_free_slots':
                return $this->taskFreeSlotsReport($conference);
                break;
            case 'tasks_table_dump':
                return $this->tableDump('tasks', $conference);
                break;

            default:
                abort(404, "No report for $name at " . $conference->key);
                break;
        }
    }

    public function svAcceptedMinutesAgo(Conference $conference, $minutes = 60)
    {
        $columns = collect([
            $this->buildColumn('firstname', 'Firstname', false, true),
            $this->buildColumn('lastname', 'Lastname', false, true),
            $this->buildColumn('email', 'E-Mail', false, true),
            $this->buildColumn('updated_at', 'Changed', true),
        ]);

        $svs = app('App\Http\Controllers\ConferenceController')
            ->svsInStateForMinutes($conference, State::byName('accepted'), $minutes);

        $data = $svs
            ->map(function ($sv) {
                return [
                    "user_id" => $sv->id,
                    'firstname' => $sv->firstname,
                    'lastname' => $sv->lastname,
                    'email' => $sv->email,
                    'updated_at' => $sv->permissions->first()->updated_at->format('c')
                ];
            });

        return ["columns" => $columns, "data" => $data, "updated" => Carbon::create('now'), "paginate" => $svs->count() > 10 ? true : false];
    }

    public function svDetailReport(Conference $conference)
    {
        $columns = collect([]);

        $svs = User
            ::whereHas('permissions', function ($query) use ($conference) {
                $query->where('conference_id', $conference->id);
                $query->where('role_id', Role::byName('sv')->id);
            })
            ->with([
                'permissions' => function ($query) use ($conference) {
                    $query->where('conference_id', $conference->id);
                    $query->where('role_id', Role::byName('sv')->id);
                },
                'permissions.enrollmentForm',
                'permissions.state',
                'degree',
                'university',
                'country',
                'region',
                'city',
                'shirt',
                'locale',
            ])
            ->get();

        $columns = collect();
        $svs = $svs->map(function ($sv) use (&$columns) {
            $additionalFields = collect();
            $form = $sv->permissions->first()->enrollmentForm;
            if ($form) {
                $body = json_decode($form->body);
                if ($body) {
                    $additionalFields->put('sv_form_header', $body->header ?? '');
                    $additionalFields->put('sv_form_agreement', $body->agreement ?? '');
                    foreach ($body->fields as $key => $field) {
                        $additionalFields->put("sv_form_value_$key", $field->value !== null ? $field->value : '');
                    }
                }
            }

            $sv = collect([
                "user_id" => $sv->id,
                "firstname" => $sv->firstname,
                "lastname" => $sv->lastname,
                "email" => $sv->email,
                "past_conferences" => is_array($sv->past_conferences) ? implode('; ', $sv->past_conferences) : "",
                "past_conferences_sv" => is_array($sv->past_conferences_sv) ? implode('; ', $sv->past_conferences_sv) : "",
                "country" => $sv->country->name ?? '',
                "region" => $sv->region->name ?? '',
                "locale_code" => $sv->locale->code ?? '',
                "locale" => $sv->locale->name ?? '',
                "university_id" => $sv->university->id ?? '',
                "university" => $sv->university->name ?? $sv->university_fallback ?? '',
                "shirt_id" => $sv->shirt->id ?? '',
                "shirt_cut" => $sv->shirt->cut ?? '',
                "shirt_size" => $sv->shirt->size ?? '',
                "degree_id" => $sv->degree->id ?? '',
                "degree" => $sv->degree->name ?? '',

                "sv_enrolled_at" => $sv->permissions->first()->created_at->format('c') ?? '',
                "sv_state" => $sv->permissions->first()->state->name ?? '',
                "sv_lottery_position" => $sv->permissions->first()->lottery_position ?? '',
                "sv_form_name" => $form ? $form->name : '',
                "sv_form_updated" => $form ? $form->updated_at->format('c') : '',
            ]);
            if ($form) {
                $sv = $sv->merge($additionalFields);

                // Create those columns object based on
                // the firm enrollment form we find
                if ($columns->isEmpty()) {
                    foreach ($sv as $key => $value) {
                        $columns = $columns->push(
                            $this->buildColumn(
                                $key,
                                ucwords(str_replace('_', ' ', $key)),
                                is_numeric($value),
                                true
                            )
                        );
                    }
                }
            }

            return $sv;
        });

        return ["columns" => $columns, "data" => $svs, "updated" => Carbon::create('now'), "paginate" => true];
    }


    public function svDemoReport(Conference $conference, $type)
    {

        $data = collect();
        $columns = collect([
            $this->buildColumn('name', 'Name', false, true),
            $this->buildColumn('code', 'Code', false, true),
            $this->buildColumn('count_total', 'Total', true),
        ]);

        foreach (collect(['enrolled', 'accepted', 'waitlisted', 'dropped']) as $state) {
            $columns->push($this->buildColumn("count_$state", "State " . ucwords($state), true));
        }

        if ($type == "country") {
            $class = Country::class;
        } else if ($type == "language") {
            $class = Language::class;
        }

        $data = $class::with([
            'users' => function ($query) use ($conference) {
                $query->whereHas('permissions', function ($query) use ($conference) {
                    $query->where('conference_id', $conference->id);
                    $query->where('role_id', Role::byName('sv')->id);
                });
            },
            'users.permissions' => function ($query)  use ($conference) {
                $query->where('conference_id', $conference->id);
                $query->where('role_id', Role::byName('sv')->id);
                $query->has('state');
            },
            'users.permissions.state'
        ])
            ->get();

        $data = $data->map(function ($obj) use ($type) {
            $c = collect([
                'name' => $obj->name,
                'code' => $type == 'country' ? $obj->iso2 : $obj->code,
                'count_total' => $obj->users->count()
            ]);

            foreach (collect(['enrolled', 'accepted', 'waitlisted', 'dropped']) as $state) {
                $count = $obj->users->filter(function ($user) use ($state) {
                    return $user->permissions->first()->state->name === $state;
                })->count();
                $c->put("count_$state", $count);
            }
            return $c;
        });

        return ["columns" => $columns, "data" => $data, "updated" => Carbon::create('now'), "paginate" => true];
    }

    public function tableDump($table, Conference $conference = null)
    {
        $columns = collect([]);

        // We select the table we want to dump
        $query = DB::table($table);

        // If this method was called with a conference
        // we want to limit the call to the given conference's scope
        if ($conference) {
            $query->where('conference_id', $conference->id);
        }

        // Get all the items which match the query
        $items = $query->get();

        // If there is no element abort
        abort_if($items->isEmpty(), 400, "Table is empty");

        // First we construct the columns array
        // from the first element
        foreach ($items->first() as $key => $value) {
            $column = $this->buildColumn(
                $key,
                $key,
                is_numeric($value),
                true
            );
            $columns->push($column);
        }

        return ["columns" => $columns, "data" => $items, "updated" => Carbon::create('now'), "paginate" => true];
    }

    public function taskFreeSlotsReport(Conference $conference)
    {
        $columns = collect([
            $this->buildColumn('day', 'Task day'),
            $this->buildColumn('name', 'Task name'),
            $this->buildColumn('start', 'Task start'),
            $this->buildColumn('end', 'Task end'),
            $this->buildColumn('hours', 'Task hours', true),
            $this->buildColumn('slots', 'Task slots', true),
            $this->buildColumn('free_slots', 'Task free slots', true),
        ]);

        $data = $conference
            ->tasks()
            ->with([
                'assignments:id,task_id',
            ])
            ->get(['id', 'date', 'name', 'start_at', 'end_at', 'hours', 'slots']);

        $data->transform(function ($task) {
            return [
                "day" => $task->date->toDateString(),
                "name" => $task->name,
                "start" => Carbon::create($task->start_at)->isoFormat('HH:mm'),
                "end" => Carbon::create($task->end_at)->isoFormat('HH:mm'),
                "hours" => $task->hours,
                "slots" => $task->slots,
                "free_slots" => $task->slots - $task->assignments->count()
            ];
        });

        $data = $data->filter->free_slots;

        return ["columns" => $columns, "data" => $data->values(), "updated" => Carbon::create('now'), "paginate" => true];
    }

    public function taskOverviewReport(Conference $conference)
    {

        $doneState = State::byName('done', 'App\Assignment');

        $columns = collect([
            $this->buildColumn('day', 'Day'),
            $this->buildColumn('task_count', '# Tasks'),
            $this->buildColumn('task_hours', 'Task hours', true),
            $this->buildColumn('task_slots', 'Slots', true),
            $this->buildColumn('task_free_slots', 'Free Slots', true),
            $this->buildColumn('assignment_count', 'Assignments', true),
            $this->buildColumn('assignment_hours', 'Assignment hours', true),
            $this->buildColumn('assignment_hours_done', 'Assignment hours done', true),
            $this->buildColumn('assignment_hours_not_done', 'Assignment hours not done', true),
        ]);


        $data = $conference
            ->tasks()
            ->with([
                'assignments:id,hours,state_id,task_id',
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
                "task_slots" => $day->sum('slots'),
                "task_free_slots" => $day->sum('slots') - $assignmentsCount,
                "assignment_count" => $assignmentsCount,
                "assignment_hours" => $assignmentsHours,
                "assignment_hours_done" => $assignmentsHoursDone,
                "assignment_hours_not_done" => $assignmentsHours - $assignmentsHoursDone,
            ];
        });

        return ["columns" => $columns, "data" => $data->values(), "updated" => Carbon::create('now')];
    }

    public function svHoursReport(Conference $conference)
    {
        $doneState = State::byName('done', 'App\Assignment');

        $columns = collect([
            $this->buildColumn('firstname', 'Firstname'),
            $this->buildColumn('lastname', 'Lastname'),
            $this->buildColumn('hours_done', 'Hours Done', true),
            $this->buildColumn('assignments_count', 'Assignments', true),
        ]);

        $data = $conference
            ->users(Role::byName('sv'))
            ->where('state_id', State::byName('accepted')->id)
            ->with([
                'assignments' => function ($query) use ($doneState, $conference) {
                    $query->select(['id', 'state_id', 'user_id', 'task_id', 'hours']);
                    $query->whereHas('task', function ($query) use ($conference) {
                        $query->where('conference_id', $conference->id);
                    });
                }
            ])
            ->get(['users.id', 'firstname', 'lastname'])
            ->map(function ($sv) use ($doneState) {
                $hoursDone = round($sv->assignments->where('state_id', $doneState->id)->sum('hours'), 2);
                $assignmentsCount = $sv->assignments->count();

                return [
                    'user_id' => $sv->id,
                    'firstname' => $sv->firstname,
                    'lastname' => $sv->lastname,
                    'hours_done' => $hoursDone,
                    'assignments_count' => $assignmentsCount,
                ];
            });
        return ["columns" => $columns, "data" => $data, "updated" => Carbon::create('now'), "paginate" => true];
    }

    public function svBidsReport(Conference $conference)
    {
        $columns = collect([
            $this->buildColumn('firstname', 'Firstname'),
            $this->buildColumn('lastname', 'Lastname'),
            $this->buildColumn('bids_zero', '# Bids Unavailable', true),
            $this->buildColumn('bids_one', '# Bids Low', true),
            $this->buildColumn('bids_two', '# Bids Medium', true),
            $this->buildColumn('bids_three', '# Bids High', true),
            $this->buildColumn('bids_higher_two', '# Bids >= Medium', true),
            $this->buildColumn('bids_total', '# Bids', true),
        ]);

        $data = $conference
            ->users(Role::byName('sv'))
            ->where('state_id', State::byName('accepted')->id)
            ->with([
                'bids' => function ($query) use ($conference) {
                    $query->select(['id', 'user_id', 'task_id', 'preference']);
                    $query->whereHas('task', function ($query) use ($conference) {
                        $query->where('conference_id', $conference->id);
                    });
                }
            ])
            ->get(['users.id', 'firstname', 'lastname'])
            ->map(function ($sv) {
                $bidsZero = $sv->bids->where('preference', 0)->count();
                $bidsOne =  $sv->bids->where('preference', 1)->count();
                $bidsTwo = $sv->bids->where('preference', 2)->count();
                $bidsThree = $sv->bids->where('preference', 3)->count();
                $bidsHigherTwo = $bidsTwo + $bidsThree;


                return [
                    'user_id' => $sv->id,
                    'firstname' => $sv->firstname,
                    'lastname' => $sv->lastname,
                    'bids_zero' => $bidsZero,
                    'bids_one' => $bidsOne,
                    'bids_two' => $bidsTwo,
                    'bids_three' => $bidsThree,
                    'bids_higher_two' => $bidsHigherTwo,
                    'bids_total' => $bidsZero + $bidsOne + $bidsTwo + $bidsThree,
                ];
            });
        return ["columns" => $columns, "data" => $data, "updated" => Carbon::create('now'), "paginate" => true];
    }

    public function shirtsReport(Conference $conference)
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

        return ["columns" => $columns, "data" => $data, "updated" => Carbon::create('now'), "paginate" => false];
    }

    public function buildColumn(String $key, String $label, bool $numeric = false, bool $searchable = false, bool $sortable = true, String $width = null)
    {
        return [
            'field' => $key,
            'label' => $label,
            'width' => $width,
            'numeric' => $numeric,
            'sortable' => $sortable,
            'searchable' => $searchable ? true : !$numeric,
        ];
    }
}