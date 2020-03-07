<?php

namespace App\Jobs;

use App\Job;
use App\JobParameters;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;

class AdvancedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $job_id;
    public $tries = 3;
    public $delayOnFail = 5;

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
            $job->markAsSuccessful($result);
        } catch (Throwable $e) {
            if ($this->attempts() <= $this->tries) {
                $job->markAsSoftFail();
                $job->setStartIn($this->delayOnFail);
                $this->release($this->delayOnFail);
            } else {
                $this->fail($e);
            }
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
        Job::find($this->job_id)->setProgress($percent);
    }

    /**
     * Set the jobs status message for longer running tasks
     * This is optional and only really recommended for
     * tasks that run more than a few seconds.
     * 
     * @param String $message The status message
     * @return void
     */
    public function setStatusMessage(String $message, int $percent = null)
    {
        Job::find($this->job_id)->setStatusMessage($message, $percent);
    }

    /**
     * The job failed to process (laravel callback)
     *
     * @param  Exception  $exception
     * @return void
     */
    public function failed(Exception $e)
    {
        Job::find($this->job_id)->markAsFailed($e->getMessage() . " " . $e->getTraceAsString())->save();
    }
}

interface ExecutableJob
{
    function execute();
}