<?php

/**
 * This is a helper class to provide more than one
 * parameter on a new App\Jobs\* job
 * We need the id to later declare the task done
 * and provide additional results from the job
 */

namespace App;

class JobParameters
{
    public $job_id;
    public $payload;

    public function __construct($job_id, $payload)
    {
        $this->job_id = $job_id;
        $this->payload = $payload;
    }
}