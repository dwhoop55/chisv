<?php

/**
 * This is the lottery
 * it will change the enrollment state
 * to 'accepted' or 'waitlisted' for users.
 * First a lottery position is given out randomly
 * for every SV which is in the state 'enrolled'. 
 * 
 * We then continue to mark SVs 'accepted' as long as there
 * are free SV positions for the conference. 
 * After the max number of SVs are accepted
 * the lottery will continue to set the state
 * to 'waitlisted' for all SVs which are still
 * in the state 'enrolled'. This will put them
 * at the end of the waitlist (if there are SVs on)
 * 
 * SVs in state 'dropped' are not processed at all 
 */

namespace App\Jobs;

use App\Conference;
use App\JobParameters;
use App\Role;
use App\State;

class Lottery extends AdvancedJob implements ExecutableJob
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
        $this->conference = Conference::find($params->payload->conference_id);
    }

    /**
     * Execute the job.
     *
     * @return mixed The job's result
     */
    public function execute()
    {

        $this->setProgress(5);
        $total = [
            'processed' => 0,
            'accepted' => 0,
            'waitlisted' => 0,
            'still_waitlisted' => 0
        ];

        // First we give out new lottery positions to all the 'enrolled'
        // SVs
        $permissionsToPosition = $this->conference->permissions
            ->where('role_id', Role::byName('sv')->id)
            ->where('state_id', State::byName('enrolled')->id);

        $this->setProgress(15);
        // Randomly order the permissions for the lottery
        $permissionsToPosition = $permissionsToPosition->shuffle();
        $this->setProgress(20);

        // Get the largest lottery position and assign new SVs
        // a number larger
        $maxPosition = $this->conference->permissions->max('lottery_position');

        // Give out the numbers
        foreach ($permissionsToPosition as $permission) {
            $permission->lottery_position = ++$maxPosition;
            $permission->save();
            $total['processed']++;
        }
        $this->setProgress(30);

        // Second we need to accept SVs ('enrolled' and 'waitlisted')
        // For that we need to know the free slots:
        $openPositions = ($this->conference->volunteer_max)
            - ($this->conference
                ->permissions
                ->where('state_id', State::byName('accepted')->id)
                ->count());

        // Since Elloquent has easier api for AND WHERE we negate the argument
        $permissionsToAccept = $this->conference->permissions
            ->where('role_id', Role::byName('sv')->id)
            ->where('state_id', '!=', State::byName('dropped')->id)
            ->where('state_id', '!=', State::byName('accepted')->id)
            ->sortBy('lottery_position');

        $this->setProgress(50);

        // Loop through all permissions which have to be accepted
        foreach ($permissionsToAccept as $permission) {
            if ($total['accepted'] < $openPositions) {
                // Still slots available for SVs,
                // make the current SV 'accepted'
                $permission->state()->associate(State::byName('accepted'));
                $total['accepted']++;
            } else if ($permission->state != State::byName('waitlisted')) {
                // No more slots, put the SV which is not on the
                // waitlist yet on the waitlist 
                $permission->state()->associate(State::byName('waitlisted'));
                $total['waitlisted']++;
            } else if ($permission->state == State::byName('waitlisted')) {
                $total['still_waitlisted']++;
            }
            $permission->save();
        }


        return $total;
    }
}