<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\Degree;
use App\Language;
use App\Locale;
use App\Region;
use App\Role;
use App\Shirt;
use App\State;
use App\Timezone;
use App\University;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * Various methods that creating a controller for would be too much
 */
class MiscController extends Controller
{

    /**
     * @group Generic Resources
     * 
     * Bootstrap ressources for the SPA, like countries, roles, etc.
     * @queryParam with Array<String> Array of objects to return Example: ["locales", "self", "countries"]
     * 
     */
    public function bootstrapRessources(Request $request)
    {
        $with = collect(json_decode(request()->query('with'))) ?? null;
        $data = collect();
        $user = auth('api')->user();

        if ($user && ($with->isEmpty() || $with->contains("self"))) {
            $controller = new UserController();
            $data->put('self', $controller->showSelf($user));
        }

        if ($with->isEmpty() || $with->contains("locales")) {
            $data->put('locales', Locale::get());
        }

        if ($with->isEmpty() || $with->contains("shirts")) {
            $data->put('shirts', Shirt::get());
        }

        if ($with->isEmpty() || $with->contains("degrees")) {
            $data->put('degrees', Degree::get());
        }

        if ($with->isEmpty() || $with->contains("languages")) {
            $data->put('languages', Language::get());
        }

        if ($with->isEmpty() || $with->contains("countries")) {
            $data->put('countries', Country::get());
        }

        if ($with->isEmpty() || $with->contains("states")) {
            $data->put('states', State::get());
        }

        if ($with->isEmpty() || $with->contains("role")) {
            $data->put('roles', Role::get());
        }

        if ($with->isEmpty() || $with->contains("version")) {
            $data->put('version', $this->version());
        }

        if ($with->isEmpty() || $with->contains("timezones")) {
            $data->put('timezones', Timezone::all());
        }

        return $data;
    }

    public function showSpa(Request $request)
    {
        return view('layouts.app');
    }

    public function loginAs(Request $request)
    {
        if ($request->input('id')) {
            $id = $request->input('id');
            $ok = Auth::user()->can('loginAs', User::find($id));
            if ($ok) {
                Auth::logout();
                Auth::loginUsingId($id);
                return redirect('/');
            } else {
                Log::critical("User (id) " . Auth::user()->id . " tried to use loginAs for " . $id . " and was not authorized!");
                return abort(403, 'You are not authorized or the user holds chair/admin permissions.');
            }
        } else {
            return redirect('/');
        }
    }

    /**
     * @group Generic Resources
     * 
     * Get all cities for a country by country id and an optional search string
     * 
     * @urlParam country required The country the city is in Example: 82
     * @queryParam name string The name of the city to search for Example: Aachen
     * 
     */
    public function citiesInCountry(Country $country)
    {
        $name = trim(request()->query('name'));
        $umlName = strtr($name, ['Ä' => 'A', 'Ü' => 'U', 'Ö' => 'O', 'ä' => 'a', 'ü' => 'u', 'ö' => 'o', 'ß' => 'B']);
        $cities = City
            ::where('country_id', $country->id)
            ->where(function ($query) use ($name, $umlName) {
                $query->where('name', 'LIKE', $name . '%');
                $query->orWhere('name', 'LIKE', $umlName . '%');
            })
            ->with(['region'])
            // ->orderBy('name', 'asc')
            ->limit(1000)
            ->get(['id', 'name', 'region_id', 'region'])
            ->sortBy(function ($city) {
                return strlen($city->name);
            })
            ->sortBy(function ($city) use ($name, $umlName) {
                return similar_text(strtolower($name), strtolower($city->name));
            });



        return $cities->transform(function ($city) {
            return [
                'id' => $city->id,
                'name' => $city->name,
                'region' => $city->region,
            ];
        })->values();
    }

    /**
     * @group Generic Resources
     * 
     * Get all universities matching a pattern
     * 
     * @urlParam pattern The pattern to match Example: Aachen
     * 
     */
    public function universities(Request $request)
    {
        $pattern = trim(request()->query('name'));
        $patterns = preg_split("/\ |\-|,|;/", $pattern);
        $query = University
            ::where('name', 'LIKE', '%' . $pattern . '%')
            ->orWhere('url', 'LIKE', '%' . $pattern . '%');
        foreach ($patterns as $item) {
            $query = $query->where('name', 'LIKE', '%' . $item . '%');
            $query = $query->orWhere('url', 'LIKE', '%' . $item . '%');
        }
        $matches = $query->orderBy('name', 'asc')->get();
        return $matches;
    }

    /**
     * Get CHISV version info
     * 
     * @response {
     * "branch":"dev","commit":"7eb66fd398b7cf361fb688cddc5af60ed5820636","tag":null
     * }
     * 
     */
    public function version()
    {
        $branch = null;
        $commit = null;
        $tag = null;

        try {
            $currentHead = trim(substr(file_get_contents('../.git/HEAD'), 4));
            $branch = str_replace('refs/heads/', '', $currentHead);
            $commit = trim(file_get_contents(sprintf('../.git/%s', $currentHead)));

            // Get the tag if there is one
            $tagPath = '../.git/refs/tags/';
            $tag = null;
            $tags = scandir($tagPath);
            foreach ($tags as $curTag) {
                if ($curTag == '.' || $curTag == "..") continue;
                $curCommit = trim(file_get_contents($tagPath . $curTag));
                if ($curCommit == $commit) {
                    $tag = $curTag;
                }
            }
        } catch (\Throwable $th) {
        }

        return compact('branch', 'commit', 'tag');
    }
}