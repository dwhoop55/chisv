<?php

/** 
 * This is a wrapper around the App\Jobs\*
 * Job. We need this wrapper to maintain a list
 * of Jobs, since laravel will purge them from the
 * queue when they succeeded. Additionally we can
 * now get hold of who started the job and also handle
 * jobs which return data when they complete, like the
 * App\Jobs\Lottery.
 * 
 * So: App\Job is just a Eloquent Model to represent
 * multiple jobs and persist their existence to the
 * 'jobs' table. An App\Job object will receive a
 * reference to the Class ($handler) of the App\Jobs\* to run
 * and also the payload the job may need.
 * To make App\Job and App\Jobs\* distinguishable
 * from now on we call App\Jobs\* a 'handler'.
 * 
 * When then executing the job the App\Job object will
 * persist it self to 'jobs' table and dispatch the App\Jobs\*
 * job while passing a helper object JobParameters to
 * that handler. It contains the jobId and the payload
 * 
 * This reference is used by the App\Jobs\* job to
 * mark itself as complete, return additional data,
 * set its progress or status message.
 *
 * Every Job extends AdvancedJob and implements the
 * ExecuteableJob Interface (see AdvancedJob) to make
 * sure it contains an execute() function. The
 * AdvancedJob will execute the execute() method
 * when its handle() method is called by laravel.
 * The subclass of AdvancedJob will be able to access
 * the extended functions like progress setting which
 * will then again take this Elloquent Model from the
 * database and alter its state.
 * 
 * Job.php - Elloquent Model for holding additional info
 *    |<-- AdvancedJob interacts with, calls execute() when handle()'ed
 *       |<-- Subclasses and implements ExecutableJob: Lottery/Auction 
 * 
 */

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\JobParameters;
use Illuminate\Queue\Jobs\Job as QueueJob;

class Job extends Model
{

    protected $with = ['state'];
    protected $guarded = [];
    protected $casts = [
        'progress' => 'int',
        'state_id' => 'int',
    ];

    public function setState(State $state)
    {
        $this->state()->associate($state)->save();
        return $this;
    }

    public function state()
    {
        return $this->belongsTo('App\State');
    }

    public function saveAndDispatch(Carbon $startAt = null)
    {
        $startAt = $startAt ?? Carbon::now();
        $this->start_at = $startAt;
        $delay = $startAt->diffInSeconds(Carbon::now());
        $this->payload = json_encode($this->payload);
        $this->save();

        $params = new JobParameters($this->id, json_decode($this->payload));
        return $this->handler::dispatch($params)->delay($delay);
    }

    /**
     * Set the jobs progress in percent
     */
    public function setProgress(int $percent)
    {
        if ($percent > 100) {
            $percent = 100;
        } else if ($percent < 0) {
            $percent = 0;
        }
        $this->progress = round($percent);
        $this->save();
        return $this;
    }

    public function setResult($result)
    {
        $this->result = json_encode($result);
        $this->save();
        return $this;
    }

    public function setStatusMessage($message, $percent = null)
    {
        $this->status_message = $message;
        if ($percent !== null) {
            if ($percent > 100) {
                $percent = 100;
            } else if ($percent < 0) {
                $percent = 0;
            }
            $this->progress = $percent;
        }
        $this->save();
        return $this;
    }

    public function markAsProcessing()
    {
        $this->setState(State::byName('processing'));
        $this->save();
        return $this;
    }

    public function markAsFailed($result = null)
    {
        $this->setState(State::byName('failed'))->setEndedNow();
        if ($result) {
            $this->setResult($result);
        }
        $this->save();
        return $this;
    }

    public function markAsSoftFail()
    {
        $this->setState(State::byName('softfail'));
        $this->save();
        return $this;
    }

    public function markAsSuccessful($result = null)
    {
        $this->setState(State::byName('successful'))->setEndedNow()->setProgress(100);
        if ($result) {
            $this->setResult($result);
        }
        $this->save();
        return $this;
    }

    public function setEndedNow()
    {
        $this->ended_at = Carbon::now();
        $this->save();
        return $this;
    }

    public function setStartIn($seconds)
    {
        $this->start_at = Carbon::now()->addSecond($seconds)->toDateTimeString();
        $this->save();
        return $this;
    }
}