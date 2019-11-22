<?php

namespace App\Http\Controllers;

use App\Http\Resources\Jobs;
use App\Job;
use Illuminate\Http\Request;

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
        return new Jobs(Job::orderBy('id', 'desc')->take(50)->get());
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



    // Blade views

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showIndex()
    {
        return view('job.index');
    }
}