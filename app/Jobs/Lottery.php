<?php

namespace App\Jobs;

use App\Conference;
use App\Job;
use App\Role;
use App\State;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Lottery implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $conference;
    public $jobModel;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Job $job)
    {
        $this->conference = $job->payload;
        $this->jobModel = $job;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
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

        // Randomly order the permissions for the lottery
        $permissionsToPosition = $permissionsToPosition->shuffle();

        // Get the largest lottery position and assign new SVs
        // a number larger
        $maxPosition = $this->conference->permissions->max('lottery_position');

        // Give out the numbers
        foreach ($permissionsToPosition as $permission) {
            $permission->lottery_position = ++$maxPosition;
            $permission->save();
            $total['processed']++;
        }

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

        $this->jobModel->markAs(State::byName('successful'));
        $this->jobModel->saveResult($total);
    }
}