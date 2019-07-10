<?php

namespace App\Http\Controllers;

use App\Conference;
use App\User;
use Illuminate\Http\Request;

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
    public function index()
    {
        $conferences = Conference::with('State')->get();
        return view('conference.index', compact('conferences'));
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
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:conferences|max:100',
            'tag' => 'required|unique:conferences|max:30',
            'location' => 'max:100',
            'date' => 'max:100',
            'description' => 'max:1000',
        ]);

        Conference::create($validatedData);
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
        return view('conference.edit', compact("conference"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Conference  $conference
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Conference $conference)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'tag' => 'required|max:30',
            'location' => 'max:100',
            'date' => 'max:100',
            'description' => 'max:1000',
        ]);

        $conference->update($validatedData);
        return redirect()->route('conference.show', $conference->slug);
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