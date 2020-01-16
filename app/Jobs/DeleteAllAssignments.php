<?php

namespace App\Jobs;

use App\Conference;
use App\JobParameters;
use Carbon\Carbon;

class DeleteAllAssignments extends AdvancedJob implements ExecutableJob
{
    public $conference;
    public $date;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(JobParameters $params)
    {
        parent::__construct($params);
        $this->conference = Conference::find($params->payload->conference_id);
        $this->date = new Carbon($params->payload->date);
    }


    /**
     * Execute the job.
     *
     * @return mixed The job's result
     */
    public function execute()
    {
        $this->setProgress(0);

        $assignments = $this
            ->conference
            ->assignments()
            ->with('task')
            ->whereDate('tasks.date', $this->date)
            ->get();

        $count = $assignments->count();
        $completed = 0;

        $assignments->each(function ($assignment) use ($count, &$completed) {
            $assignment->delete();
            $completed++;
            $this->setProgress(100 / $count * $completed);
        });

        return ['deleted' => $count];
    }
}