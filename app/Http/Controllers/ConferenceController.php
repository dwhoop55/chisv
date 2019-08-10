<?php

namespace App\Http\Controllers;

use App\Conference;
use App\State;
use App\Timezone;
use App\User;
use App\Http\Requests\ConferenceRequest;
use Dotenv\Exception\InvalidFileException;
use App\Image;
use Illuminate\Support\Facades\Storage;
use App\Role;

class ConferenceController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // This will only authorize CRUD, not the index
        // we authorize it manually
        $this->authorizeResource(Conference::class);
    }

    /** 
     * Enrolls a user to be an SV for the conference
     * 
     * @param \App\Conference conference
     * @return \Illuminate\Http\Response
     */
    public function enroll(Conference $conference)
    {
        $user = auth()->user();
        $result = $user->grant(Role::byName('sv'), $conference, State::byName('enrolled'));
        return ["success" => $result, "message" => "You are now enrolled"];
        // $user = auth()->user();
        // if ($user->can('enroll', $conference)) {
        //     if ($user->grant(Role::byName('sv'), $conference, State::byName('enrolled'))) {
        //         return back()->with('success', 'Your are now enrolled for ' . $conference->name);
        //     }
        // } else {
        //     return back()->withErrors(['error', 'You cannot enroll for this conference']);
        // }
    }

    /** 
     * Unenrolls a user from the conference
     * 
     * @param \App\Conference conference
     * @return \Illuminate\Http\Response
     */
    public function unenroll(Conference $conference)
    {
        $user = auth()->user();
        $result = $user->revoke(Role::byName('sv'), $conference);
        return ["success" => $result, "message" => "You are now longer enrolled"];
        // $user = auth()->user();
        // if ($user->can('unenroll', $conference)) {
        //     if ($user->revoke(Role::byName('sv'), $conference)) {
        //         return back()->with('success', 'Your are no longer enrolled for ' . $conference->name);
        //     }
        // } else {
        //     return back()->withErrors(['error', 'You cannot unenroll from this conference']);
        // }
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
        $result = Conference::create($validated);
        return ["success" => $result, "message" => "Conference created"];
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
        // // TODO: data is validated, this is not required anymore
        // $validated = $request->validated();

        // // Process icon upload
        // if (isset($validated['icon'])) {
        //     $file = $validated['icon'];
        //     $name = 'conference-icon-' . $conference->id . "." . $file->extension();
        //     $path = "/storage/$name";
        //     $type = 'icon';
        //     if (Storage::disk('public')->put($name, $file->get())) {
        //         $dbImage = new Image(compact('name', 'path', 'type'));
        //         $conference->icon()->delete();
        //         $conference->icon()->save($dbImage);
        //     } else {
        //         throw new InvalidFileException("The icon could not be stored");
        //     }
        // }

        // // Process image upload
        // if (isset($validated['image'])) {
        //     $file = $validated['image'];
        //     $name = 'conference-image-' . $conference->id . "." . $file->extension();
        //     $path = "/storage/$name";
        //     $type = 'image';
        //     if (Storage::disk('public')->put($name, $file->get())) {
        //         $dbImage = new Image(compact('name', 'path', 'type'));
        //         $conference->image()->delete();
        //         $conference->image()->save($dbImage);
        //     } else {
        //         throw new InvalidFileException("The image could not be stored");
        //     }
        // }

        // if (isset($validated['delete_icon'])) {
        //     unset($validated['delete_icon']);
        //     $name = $conference->icon->name;
        //     Storage::disk('public')->delete($name);
        //     $conference->icon()->delete();
        // }

        // if (isset($validated['delete_image'])) {
        //     unset($validated['delete_image']);
        //     $name = $conference->image->name;
        //     Storage::disk('public')->delete($name);
        //     $conference->image()->delete();
        // }

        // if (!$request->has('enable_bidding')) $validated['enable_bidding'] = 0;
        // $conference->update($validated);
        // return redirect()->route('conference.show', $conference->key);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Conference  $conference
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conference $conference)
    {
        $result = $conference->delete();
        return ["success" => $result, "message" => "Conference deleted"];
    }


    // Blade views

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showIndex()
    {

        // Ask the ConferencePolicy if index is allowed for that user
        $this->authorize('index', Conference::class);

        $conferences = Conference::all()->filter(function ($conference) {
            return auth()->user()->can('view', $conference);
        });

        $user = auth()->user();
        $overState = State::byName('over');
        $planningState = State::byName('planning');

        return view('conference.index', compact('user', 'conferences', 'overState', 'planningState'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCreate()
    {
        $this->authorize('create', Conference::class);
        return view('conference.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Conference  $conference
     * @return \Illuminate\Http\Response
     */
    public function showModel(Conference $conference)
    {
        $overState = State::byName('over');
        $planningState = State::byName('planning');
        $user = auth()->user();
        // $fullContent = true;
        return view('conference.show', compact('fullContent', 'user', 'conference', 'overState', 'planningState'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Conference  $conference
     * @return \Illuminate\Http\Response
     */
    public function showEdit(Conference $conference)
    {
        $this->authorize('update', $conference);
        return view('conference.edit', compact('conference'));
    }
}