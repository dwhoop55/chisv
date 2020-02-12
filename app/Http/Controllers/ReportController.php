<?php

namespace App\Http\Controllers;

use App\Conference;
use App\Role;
use App\Shirt;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Conference $conference, String $name)
    {
        switch ($name) {
            case 'shirt':
                return $this->shirtReport($conference);
                break;

            default:
                abort(404, "No report for $name at " . $conference->key);
                break;
        }
    }

    public function shirtReport($conference)
    {
        $columns = collect();
        $data = Shirt::all()->push(new Shirt(["id" => null, "cut" => "unknown", "size" => "unknown"]));
        $shirts = $conference
            // We get all the users for this conference
            ->users(Role::byName('sv'))
            // With their shirt attribute
            ->with(['shirt'])
            // And we only need these columns on the user object
            ->get(['users.id', 'users.shirt_id'])
            // Just get the shirt from the user and replace the user by the shirt
            ->map(function ($user) {
                return $user->shirt;
            });

        // Now we count the shirts

        return ["columns" => $columns, "data" => $data];
    }
}