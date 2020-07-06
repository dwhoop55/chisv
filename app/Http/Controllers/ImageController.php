<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * @authenticated
 * @group Image
 */
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

    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index()
    // {
    //     // Ask the ImagePolicy if index is allowed for that user
    //     $this->authorize('index', Image::class);
    // }

    /**
     * Create a new image
     * 
     * @bodyParam image binary-file required Binary image
     * @bodyParam name string required Image name Example: Awesome image
     * @bodyParam type string required Can be one of 'artwork', 'icon' or 'avatar'
     * @bodyParam owner_id int required Reference the image to this model Example: 1
     * @bodyParam owner_type string required Reference the image to this model class Example: App\User
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $imageValidationString = "required|image|mimes:jpeg,png,jpg,gif|between:0,1024";
        if ($request->owner_type == "App\User") {
            $imageValidationString = "$imageValidationString|dimensions:max_width=128,max_height=128";
        } else if ($request->owner_type == "App\Conference") {
            $imageValidationString = "$imageValidationString|dimensions:max_width=4096,max_height=4096";
        } else {
            $imageValidationString = "$imageValidationString|dimensions:max_width=128,max_height=128";
        }

        $data = $request
            ->validate([
                'image' => $imageValidationString,
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
     * Get an image
     * 
     * @urlParam image required The image's id Example: 1
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        return $image;
    }

    /**
     * Update an image
     * 
     * @bodyParam image binary-file required Binary image
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

        $imageValidationString = "required|image|mimes:jpeg,png,jpg,gif|between:0,5000";
        if ($image->owner_type == "App\User") {
            $imageValidationString = "$imageValidationString|dimensions:max_width=128,max_height=128";
        } else if ($image->owner_type == "App\Conference") {
            $imageValidationString = "$imageValidationString|dimensions:max_width=4096,max_height=4096";
        } else {
            $imageValidationString = "$imageValidationString|dimensions:max_width=128,max_height=128";
        }
        $data = $request->validate([
            'image' => $imageValidationString,
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
     * Delete an image
     * 
     * @urlParam image required The image's id Example: 1
     * 
     * @response 200 {
     * "result": null,"success": true,"message": "Image deleted!"
     * }
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
