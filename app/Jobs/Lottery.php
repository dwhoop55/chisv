<?php

/**
 * This is the lottery
 * The lottery algorithm will change the enrollment state from
 * enrolled and waitlisted to accepted or waitlisted.
 * Who get's accepted is pure random (with regard to the
 * waitlisted SVs which get accepted first. Yet, their position
 * on the waitlist is fixed but has been determined randomly in
 * a previous lottery run). The algorithm does not take any
 * questions of the enrollment form into account.
 * 
 * 1. We generate a randomly ordered list of SVs which are in the
 *     state "enrolled". We set a lottery-position to every SV
 *     from this list. This number is one larger as the highest
 *     lottery-position on the waitlist (max(waitlist) +1).
 *     It is 1 if the waitlist is empty. The number is incremented
 *     after each SV.
 * 2. We loop over the lottery-position in ascending order
 *     for SVs in the state waitlisted or enrolled.
 *     2.1 (If) As long as there are slots available for SVs for
 *         the conference we mark the SV as accepted.
 *     2.2 (Else) If there are no slots available anymore we mark
 *         and SV who is in the state enrolled as waitlisted.
 *         SVs which were already in the state waitlisted are not
 *         modified.
 * 
 * SVs in state dropped are not processed at all.
 * 
 * Outcome
 * After the lottery has been run we know that we accepted a
 * random subset of enrolled SVs. We also know that if there
 * has been any SVs on the waitlist those would have been
 * accepted first. Any SV who was enrolled is now either accepted
 * or has been placed on the waitlist.
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

        $acceptedState = State::byName('accepted');
        $waitlistedState = State::byName('waitlisted');

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
                ->where('role_id', Role::byName('sv')->id)
                ->where('state_id', $acceptedState->id)
                ->count());

        // Since Elloquent has easier api for AND WHERE we negate the argument
        $permissionsToAccept = $this->conference->permissions
            ->where('role_id', Role::byName('sv')->id)
            ->where('state_id', '!=', State::byName('dropped')->id)
            ->where('state_id', '!=', $acceptedState->id)
            ->sortBy('lottery_position');

        $this->setProgress(50);

        // Loop through all permissions which have to be accepted
        foreach ($permissionsToAccept as $permission) {
            if ($total['accepted'] < $openPositions) {
                // Still slots available for SVs,
                // make the current SV 'accepted'
                $permission->state()->associate($acceptedState);
                $total['accepted']++;
            } else if ($permission->state != $waitlistedState) {
                // No more slots, put the SV which is not on the
                // waitlist yet on the waitlist 
                $permission->state()->associate($waitlistedState);
                $total['waitlisted']++;
            } else if ($permission->state == $waitlistedState) {
                $total['still_waitlisted']++;
            }
            $permission->save();
        }


        return $total;
    }
}
