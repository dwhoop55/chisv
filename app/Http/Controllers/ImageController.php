<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
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
        $this->authorizeResource(Image::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Ask the ImagePolicy if index is allowed for that user
        $this->authorize('index', Image::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'required|image',
            'name' => 'required|string',
            'type' => 'required|string|in:image,icon,avatar',
            'owner_id' => 'required|integer',
            'owner_type' => 'required|string|in:App\User,App\Conference',
        ]);

        $path = $request->file('image')->store('public');
        // Adjust path here

        $owner = app($data['owner_type'])::find($data['owner_id']);
        $model = new Image(compact('name', 'path', 'type'));

        if ($data['type'] == 'image') {
            if ($owner->image) $owner->image->delete();
            $owner->image->save($model);
        } else if ($data['type'] == 'icon') {
            if ($owner->icon) $owner->icon->delete();
            $owner->icon->save($model);
        }
        // if (Storage::disk('public')->put($name, $file->get())) {
        //     $dbImage = new Image(compact('name', 'path', 'type'));
        //     // $conference->icon()->delete();
        //     // $conference->icon()->save($dbImage);
        // } else {
        //     throw new InvalidFileException("The image could not be stored");
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //
    }
}