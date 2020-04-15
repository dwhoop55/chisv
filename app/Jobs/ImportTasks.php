<?php

/**
 * This is a task importer job
 * 
 * We get one ore more tasks in as a collection
 * Based on if a single tasks has an id whe either
 * update an existing task with that id or we
 * just create a new one
 */

namespace App\Jobs;

use App\Conference;
use App\Http\Requests\TaskCreateRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\JobParameters;
use App\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class ImportTasks extends AdvancedJob implements ExecutableJob
{
    public $conference;
    public $tasks;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(JobParameters $params)
    {
        parent::__construct($params);
        $this->conference = Conference::find($params->payload->conference_id);
        $this->tasks = collect($params->payload->tasks);
    }

    /**
     * Execute the job.
     *
     * @return mixed The job's result
     */
    public function execute()
    {

        $this->setProgress(0);
        $conference = $this->conference;

        // We prepare a collection with all the existing tasks
        // for this conference. We create a key based collection
        // so that lookung by id is efficient
        $existingTasks = $this
            ->conference
            ->tasks
            ->mapWithKeys(function ($task) {
                return [$task->id => $task];
            });

        $result = collect([
            "create_success" => collect(), "create_fail" => collect(),
            "update_success" => collect(), "update_fail" => collect(),
            "mismatch" => collect(), "invalid" => collect()
        ]);
        $processed = 0;
        $total = $this->tasks->count();

        $createRules = (new TaskCreateRequest())->rules();
        $updateRules = (new TaskUpdateRequest())->rules();


        $this->tasks->each(function ($task) use ($conference, $existingTasks, &$processed, $total, &$result, $createRules, $updateRules) {
            // Now we need to differentiate between two cases:
            // Update and new creation.
            // An update has id set for a task in the collection
            // where a new creation has not

            $id = (isset($task->id) && $task->id) ? $task->id : null;
            $task = collect($task)->only([
                'name', 'description', 'location',
                'date', 'start_at', 'end_at',
                'priority', 'slots', 'hours'
            ])->toArray();

            // This is the section which makes imports of legacy chisv
            // csv possible. (1) With those we have no YYYY-MM-DD date for the task
            // but rather a conference day (1,2,..). We convert these to actual dates
            // (2) Hours can also be in a different format, namely HH:MM instead
            // of our normal float (e.g 3.5)
            // (3) Start_at end end_at might be in HH:MM format rather than
            // HH:MM:SS format which is required by the validator
            // (4) Also priorities worked different in the old chisv:
            //   app/models/task.rb:17
            //   PRIORITY = {0 => 'high', 1 => 'normal', 2 => 'low'}
            // where we would have 1 => low, 2 => normal and 3 => high
            // NOTE: In the old chisv chairs often set all tasks to 0
            // since it was not clear that this is the highest priority.
            // If we import those task exports they wind up all being high.
            // To overcome that the chair must not select priority for import
            // in the first step. If there is no priority set it will be set
            // to 1 => low. This fact is very important for the auction:
            // A task with high priority will always be filled first

            // Since we don't know when a priority is from the old system we only
            // trigger this conversion if there is also the 'date' in the old format

            // (1)
            if (preg_match("/^\d{1,}$/", $task['date'])) {
                // date is in conference day format, like 1,2,3
                $task['date'] = Carbon::create($conference->start_date)->addDay(-1)->addDay($task['date'])->toDateString();

                // (4)
                // Also convert priorities here
                if (isset($task['priority'])) {
                    //   PRIORITY = {0 => 'high', 1 => 'normal', 2 => 'low'}
                    switch ($task['priority']) {
                        case 0:
                            $task['priority'] = 3;
                            break;
                        case 1:
                            $task['priority'] = 2;
                            break;
                        case 2:
                            $task['priority'] = 1;
                            break;
                        default:
                            // will then be set during 'create' to 1
                            // but will not change for 'update'
                            unset($task['priority']);
                            break;
                    }
                }
            }

            // (2)
            $matches = null;
            if (isset($task['hours']) && preg_match("/^(\d{1,2}):(\d{2})$/", $task['hours'], $matches)) {
                // hours can be in format HH:MM
                $task['hours'] = intval($matches[1]) + round(intval($matches[2]) / 60, 2);
            }

            // (3)
            if (preg_match("/^\d{2}:\d{2}$/", $task['start_at'])) {
                $task['start_at'] = $task['start_at'] . ":00";
            }
            if (preg_match("/^\d{2}:\d{2}$/", $task['end_at'])) {
                $task['end_at'] = $task['end_at'] . ":00";
            }


            // If we have an 'id' set we update the task
            if ($id) {

                // Check for invalid fields first
                $validator = Validator::make($task, $updateRules);

                if ($validator->fails()) {
                    $result["invalid"]->push($task);
                } else { // else: valid
                    if ($existingTasks->has($id)) {
                        // Matched: Found existing task
                        $ok = $existingTasks[$id]->update($task);
                        if ($ok) {
                            $result["update_success"]->push($id);
                        } else {
                            $result["update_fail"]->push($id);
                        }
                    } else { // Mismatch: No task found
                        $result["mismatch"]->push($id);
                    }
                } // else: valid

            } else { // Create request

                // Check for invalid fields first
                $task["conference_id"] = $conference->id;
                // If no hours are set we set the difference
                // between start and end time
                if (!isset($task["hours"])) {
                    $start_at = Carbon::create($task['start_at']);
                    $end_at = Carbon::create($task['end_at']);
                    $task["hours"] = round($start_at->floatDiffInHours($end_at, false), 2);
                }

                // If there is no default priority, we set it to 1
                if (!isset($task['priority'])) {
                    $task["priority"] = 1;
                }

                $validator = Validator::make($task, $createRules);

                if ($validator->fails()) {
                    $result["invalid"]->push($task);
                } else {
                    $ok = (new Task($task))->save();
                    if ($ok) {
                        $result["create_success"]->push($id);
                    } else {
                        $result["create_fail"]->push($id);
                    }
                }
            }

            $progress = 100 / $total * ++$processed;
            $this->setProgress($progress);
        });

        return $result;
    }
}