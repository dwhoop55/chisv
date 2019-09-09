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
            'image' => 'required|image|between:0,5000',
            'name' => 'required|string',
            'type' => 'required|string|in:artwork,icon,avatar',
            'owner_id' => 'required|integer',
            'owner_type' => 'required|string|in:App\User,App\Conference',
        ]);

        // First get the owner and save the image to disk
        $disk_path = $request->file('image')->store('public/images');
        $web_path = $this->getWebPath($disk_path);


        // Now we create a new Image and try to save it to the database
        $name = $data['name'];
        $type = $data['type'];
        $owner_type = $data['owner_type'];
        $owner_id = $data['owner_id'];
        $model = new Image(compact('name', 'owner_type', 'owner_id', 'disk_path', 'web_path', 'type'));
        $result = $model->save();

        return ['result' => $model, "message" => "Upload successful!", "web_path" => $web_path];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        return $image;
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
        // NOTICE:
        // We remove the old file from disk, upload a new file which
        // will have an entirely new filename. Thus all links to the old
        // image filename will result in 404s
        // We could also overwrite the stored image with new data
        // but this would open the hell of cached image files later
        // in production. 
        $data = $request->validate([
            'image' => 'required|image|between:0,5000',
        ]);

        // Delete the old image from disk
        Storage::delete($image->disk_path);

        // First get the owner and save the image to disk
        $disk_path = $request->file('image')->store('public/images');
        $web_path = $this->getWebPath($disk_path);

        $result = $image->update(compact('disk_path', 'web_path'));

        return ['result' => $image, "message" => "Update successful!", "web_path" => $web_path];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        Storage::delete($image->disk_path);
        return ["result" => null, "success" => $image->delete(), "message" => "Image deleted!"];
    }

    public function getWebPath($path)
    {
        if ($this->startsWith($path, 'public/')) {
            return str_replace('public/', '/storage/', $path);
        } else {
            return null;
        }
    }

    function startsWith($string, $startString)
    {
        $len = strlen($startString);
        return (substr($string, 0, $len) === $startString);
    }
}