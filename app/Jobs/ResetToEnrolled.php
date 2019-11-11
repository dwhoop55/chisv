<?php

/**
 * This is an AdvancedJob job
 * This means we have to implement execute()
 * where we can return results which are persisted
 * into the jobs table. We can also throw an exception
 * in execute() and the job will be marked accordingly
 */

namespace App\Jobs;

use App\Conference;
use App\JobParameters;
use App\Role;
use App\State;

class ResetToEnrolled extends AdvancedJob implements ExecutableJob
{
    public $conference;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(JobParameters $params)
    {
        parent::__construct($params);
        $this->conference = Conference::find($params->payload->id);
    }

    /**
     * Execute the job.
     *
     * @return mixed The job's result
     */
    public function execute()
    {
        $total = ['reset' => 0];

        $permissions = $this->conference->permissions
            ->where('role_id', Role::byName('sv')->id)
            ->where('state_id', '!=', State::byName('enrolled')->id);

        foreach ($permissions as $permission) {
            $permission->state()->associate(State::byName('enrolled'));
            $permission->lottery_position = null;
            $permission->save();
            $total['reset']++;
        }

        return $total;
    }
}