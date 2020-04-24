<?php

namespace App\Http\Controllers;

use App\Job;
use Carbon\Carbon;
use Illuminate\Notifications\SendQueuedNotifications;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Job::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $take = 50;
        $total = Job::count() + DB::table('jobs_queue')->count();

        $jobObjects = Job
            ::orderBy('id', 'desc')
            ->take($take / 2)
            ->get()
            ->map(function ($job) {
                $job->type = 'job';
                return $job;
            });

        $queuedJobs = DB
            ::table('jobs_queue')
            ->orderBy('id', 'desc')
            ->take($take / 2)
            ->get()
            ->map(function ($job) {
                $payload = json_decode($job->payload);
                $data = unserialize($payload->data->command);

                if ($data instanceof SendQueuedNotifications) {
                    $to = "";
                    // if ($job->id == 7) dd($data);
                    foreach ($data->channels as $channel) {
                        if ($data->notifiables && isset($data->notifiables->id)) {
                            $to = "$to $channel notification: " . $data->notifiables->firstname . " " . $data->notifiables->lastname;
                        } else if ($data->notifiables && isset($data->notifiables->routes['mail'])) {
                            $to = "$to $channel notification: " . $data->notifiables->routes['mail'];
                        }
                    }
                    $new = [
                        'type' => 'queue',
                        'name' => trim($to),
                        'attempts' => intval($job->attempts),
                        'handler' => $payload->displayName,
                        'created_at' => Carbon::createFromTimestamp($job->created_at)->toDateTimeString(),
                        'start_at' => Carbon::createFromTimestamp($job->available_at)->toDateTimeString(),
                    ];
                    return $new;
                }
            })
            ->reject(function ($job) {
                return !$job;
            });

        foreach ($queuedJobs as $item) {
            $jobObjects->push($item);
        }

        $jobObjects = $jobObjects->sortByDesc('start_at');

        return ["data" => $jobObjects->values(), "total" => $total, "take" => $take];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        return $job;
    }
}