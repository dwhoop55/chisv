<?php

/*
 * This is the auction. It processed all bids of the SVs
 * and creates an Assignment when possible, thereby assigning
 * an SV to a task.
 * 
 * To give both sides (SVs and Chairs) a way to control the output
 * of the auction we process Task priorities (controllable by the Chairs)
 * and also bid preferences (controllable by the SV). This way
 * Chairs can ensure that a very important Task is more likely to
 * get SVs assigned than a Task with a lower priority.
 * 
 * On the other hand we respect the SVs bid preference.
 * 
 * The auction algorithm will run in two phases.
 * 1st Phase
 *  Loop through all Tasks sorted by priority descending
 *      For every task:
 *      Loop through a list of SVs which have less total_hours worked
 *      than the conference suggests. This list has to be sorted by priority
 *      descending. Each block of preferences within this list has the SVs in
 *      ascending total_hours order. Only have SVs in the list which have at least bid with
 *      preference 1 (>=). Also, only have SVs in the list which are available
 *      for the time the task is scheduled
 *      TODO: Maybe add a small additional time around the task to prevent from
 *      the SV having to be at two distant tasks whithin a minute
 *          For every SV as long the task has free slots:
 *          Assign SV to the task (create Assignment)
 * 
 * After that phase we know that all high priority tasks are more likely assigned then
 * low priority tasks. We know that SVs which have bid high on a task and are not yet
 * at the suggested hours are likely to have that task assigned. We also know that
 * are aming at an equal distribution of hours, since we sorted the SVs in their preference
 * by the hours they worked ascending.
 * 
 * However, there might be tasks still not assigned, even when SVs have bid for them. These SVs
 * have already worked the suggested max hours for the conference. We decided to anyhow assign
 * them to a task when they bid at least 1 (>=) to make sure to minimize tasks which have no
 * or not the required amount of SVs assgined.
 * 
 * 2nd Phase
 *  Loop through all tasks which have not all slots filled
 *      For every task:
 *      [do the same like in phase 1]
 *
 *   
*/

namespace App\Jobs;

use App\Conference;
use App\JobParameters;
use Carbon\Carbon;

class Auction extends AdvancedJob implements ExecutableJob
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




        return;
    }
}