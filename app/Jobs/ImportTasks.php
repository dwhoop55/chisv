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

            // We do some adjustment to date and hours, start_at, end_at
            //  and priority at this point
            // This is required to be able to import the old style
            //  chisv csv export
            //  We allow for a date (YYYY-MM-DD) but also the conference
            //  day (\d) to be compatible with an csv export of the old chisv
            // This is also true for hours, which is required to be a
            //  numeric (float) but we also allow it to be in a (HH:MM) format
            //  This section will convert the formats to make them compatible
            // start_at and end_at can be in format HH:MM but we require HH:MM:SS
            //  so we append if needed
            // Finally we need to check the priority, and push it into the boundaries
            if (preg_match("/^\d{1,}$/", $task['date'])) {
                // date is in conference day format, like 1,2,3
                $task['date'] = Carbon::create($conference->start_date)->addDay(-1)->addDay($task['date'])->toDateString();
            }
            $matches = null;
            if (isset($task['hours']) && preg_match("/^(\d{1,2}):(\d{2})$/", $task['hours'], $matches)) {
                // hours can be in format HH:MM
                $task['hours'] = intval($matches[1]) + round(intval($matches[2]) / 60, 2);
            }
            if (preg_match("/^\d{2}:\d{2}$/", $task['start_at'])) {
                $task['start_at'] = $task['start_at'] . ":00";
            }
            if (preg_match("/^\d{2}:\d{2}$/", $task['end_at'])) {
                $task['end_at'] = $task['end_at'] . ":00";
            }
            if (isset($task['priority']) && ($task['priority'] < 1 || $task['priority'] > 3)) {
                $task['priority'] = 1;
            }


            if ($id) { //Update request

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