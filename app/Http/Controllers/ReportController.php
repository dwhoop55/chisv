<?php

namespace App\Http\Controllers;

use App\Conference;
use App\Role;
use App\Shirt;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        $columns = collect([
            $this->buildColumn('cut', 'Cut'),
            $this->buildColumn('size', 'Size'),
            $this->buildColumn('count', 'Count', true),
        ]);
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
        $data->transform(function ($shirt) use ($shirts) {
            $count = $shirts->where('id', $shirt->id)->count();
            $shirt->count = $count;
            return $shirt;
        });

        return ["columns" => $columns, "data" => $data, "updated" => Carbon::create('now')];
    }

    public function buildColumn(String $key, String $label, bool $numeric = false, String $width = null, bool $sortable = true, bool $searchable = true)
    {
        return [
            'field' => $key,
            'label' => $label,
            'width' => $width,
            'numeric' => $numeric,
            'sortable' => $sortable,
            'searchable' => $searchable
        ];
    }
}