<?php

namespace App\Http\Controllers;

use App\Conference;
use App\State;
use App\Timezone;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ConferenceRequest;

class ConferenceController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Conference::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $conferences = Conference::all()->filter(function ($conference) {
            return Auth::user()->can('view', $conference);
        });

        $overState = State::byName('over');
        $planningState = State::byName('planning');

        return view('conference.index', compact('conferences', 'overState', 'planningState'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('conference.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConferenceRequest $request)
    {
        $validated = $request->validated();
        Conference::create($validated);
        return redirect()->route('conference.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Conference  $conference
     * @return \Illuminate\Http\Response
     */
    public function show(Conference $conference)
    {

        return view('conference.show', compact('conference'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Conference  $conference
     * @return \Illuminate\Http\Response
     */
    public function edit(Conference $conference)
    {
        $states = State::where('for', 'App\Conference')->get();
        $timezones = Timezone::all();
        return view('conference.edit', compact("conference", "states", "timezones"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Conference  $conference
     * @return \Illuminate\Http\Response
     */
    public function update(ConferenceRequest $request, Conference $conference)
    {
        $validated = $request->validated();
        if (!$request->has('enable_bidding')) $validated['enable_bidding'] = 0;
        $conference->update($validated);
        return redirect()->route('conference.show', $conference->key);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Conference  $conference
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conference $conference)
    {
        $conference->delete();
        return redirect()->route('conference.index');
    }
}