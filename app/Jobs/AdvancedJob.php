<?php

namespace App\Jobs;

use App\Job;
use App\JobParameters;
use Error;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AdvancedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $job_id;

    /**
     * Create a new job instance.
     *
     * @param JobParameter $params Containing a job_id and an optional payload
     * @return void
     */
    public function __construct(JobParameters $params)
    {
        if (!$params->job_id) {
            $e = new Exception('JobParameters are invalid: no job_id');
            throw $e;
        }
        $this->job_id = $params->job_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $job = Job::find($this->job_id);
        $job->markAsProcessing();

        try {
            $result = $this->execute();
            $job->markAsSuccessful($result)->save();
        } catch (Exception $e) {
            $job->markAsFailed($e->getMessage() . " " . $e->getTraceAsString())->save();
        } catch (Error $e) {
            $job->markAsFailed($e->getMessage() . " " . $e->getTraceAsString())->save();
        }
    }

    /**
     * Set the jobs progress for longer running tasks
     * This is optional and only really recommended for
     * tasks that run more than a few seconds.
     * 
     * @param int $percent The progress in percent (0-100)
     * @return void
     */
    public function setProgress(int $percent)
    {
        $job = Job::find($this->job_id)->setProgress($percent);
    }

    /**
     * Set the jobs status message for longer running tasks
     * This is optional and only really recommended for
     * tasks that run more than a few seconds.
     * 
     * @param String $message The status message
     * @return void
     */
    public function setStatusMessage(String $message)
    {
        $job = Job::find($this->job_id)->setStatusMessage($message);
    }
}

interface ExecutableJob
{
    function execute();
}