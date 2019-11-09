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
 * reference to the Class of the App\Jobs\* to run
 * and also the payload the job may need.
 * To make App\Job and App\Jobs\* distinguishable
 * from now on we call App\Jobs\* a 'handler'.
 * 
 * When then executing the job the App\Job object will
 * persist it self to 'jobs' table and dispatch the App\Jobs\*
 * job based on the start_at parameter.
 * 
 * When creating the new App\Jobs\* instance this object (here - App\Job)
 * will also pass it self as reference.
 * 
 * This reference is used by the App\Jobs\* job to
 * mark itself as complete, return additional data
 * NOTE: It would be better to wrap this extra
 * functionality into some inheritance. To always
 * make sure any implemenation of that class updates
 * the App\Job model. However this code is currently
 * in the App\Jobs\* class itself.
 * 
 */

namespace App;

use App\Jobs\Lottery;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Job extends Model
{
    /**
     * Create a new Job instance, persist it to the
     * database and place the handler in the jobs queue
     * @param string $name An identifing name used showed to the user
     * @param ShouldQueue $handler A class reference to a job from App\Jobs\
     * @param $payload Generic payload parameter, will be used to instanciate the $handler
     * @return App\Job The job object
     */
    public function __construct(string $name = "No Name", string $handler, $payload = null, Carbon $startAt = null)
    {
        $this->name = $name;
        $this->handler = $handler;
        $this->payload = $payload;
        $this->start_at = $startAt ?? Carbon::now();
        // Use the authenticated user or the admin user (which has id 1)
        $this->creator()->associate(auth()->user() ?? User::find(1));

        // The dispatcher uses seconds for delays, but we want to expose an api
        // which takes the absolute date(time)
        $delay = $this->start_at->diffInSeconds(Carbon::now());

        // Save it so that this job has an id in database
        $this->save();

        // $job = get_class(app($this->handler));
        $job = Lottery::dispatch($this)->delay(Carbon::now()->addSeconds($delay));


        // // I haven't found a way to instanciate a Jobs class from the
        // // service container AND provide dynamic parameters
        // // We throw an exception to remind the developer
        // // to implement the switch case below when he/she
        // // adds a new App\Jobs\* which uses this wrapper
        // switch ($this->handler) {
        //     case 'App\Jobs\Lottery':
        //         $job = new Lottery($this->payload, $this);
        //         $job->delay(Carbon::now()->addSeconds($delay));
        //         // ::dispatch('conference' => $this->payload, 'model' => $this])
        //         // ->delay(Carbon::now()->addSeconds($delay));
        //         break;

        //     default:
        //         throw new Exception("Missing switch case for " . $this->handler . " in the App\Job constructor");
        //         break;
        // }

        // dispatch($job);
        return $this;
    }

    public function markAs(State $state)
    {
        $this->ended_at = Carbon::now();
        $this->state()->associate($state);
        $this->save();
    }

    public function saveResult($result)
    {
        $this->result = $result;
        $this->save();
    }

    public function state()
    {
        return $this->belongsTo('App\State');
    }

    public function creator()
    {
        return $this->belongsTo('App\User');
    }
}