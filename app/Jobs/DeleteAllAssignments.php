<?php

namespace App\Jobs;

use App\Bid;
use App\Conference;
use App\JobParameters;
use App\State;
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
            ->with([
                'task',
                'task.bids',
            ])
            ->whereDate('tasks.date', $this->date)
            ->get();

        $count = $assignments->count();
        $completed = 0;

        $assignments->each->$assignments->each(function ($assignment) use ($count, &$completed) {
            $assignment->delete();
            $completed++;
            $this->setProgress(100 / $count * $completed);
        });

        // Reset all bids
        Bid
            ::whereHas('task', function ($query) {
                $query->whereDate('date', $this->date);
                $query->where("conference_id", $this->conference->id);
            })
            ->where('state_id', "!=", State::byName('placed')->id)
            ->update(['state_id' => State::byName('placed', 'App\Bid')->id]);

        return ['deleted' => $count];
    }
}