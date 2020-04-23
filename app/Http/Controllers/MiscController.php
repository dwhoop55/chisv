<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\Degree;
use App\Language;
use App\Locale;
use App\Shirt;
use App\Timezone;
use App\University;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MiscController extends Controller
{

    public function loginAs(Request $request)
    {
        if ($request->input('id')) {
            $id = $request->input('id');
            $ok = Auth::user()->can('loginAs', User::find($id));
            if ($ok) {
                Auth::logout();
                $resp = Auth::loginUsingId($id);
                return redirect('/');
            } else {
                return abort(403, 'You are not authorized or the user holds higher permissions');
            }
        }
    }

    public function locales()
    {
        return Locale::all();
    }

    public function timezones()
    {
        return Timezone::all();
    }

    public function shirts()
    {
        return Shirt::all();
    }

    public function degrees()
    {
        return Degree::all();
    }

    public function countries()
    {
        return Country::all();
    }

    public function locations(Country $country, String $pattern = "")
    {
        $pattern = trim($pattern);
        $unUmlautedPattern = strtr($pattern, ['Ä' => 'A', 'Ü' => 'U', 'Ö' => 'O', 'ä' => 'a', 'ü' => 'u', 'ö' => 'o', 'ß' => 'B']);
        $matches = City
            // Example:
            //             where
            //   "country_id" = 233
            //   and (
            //     "name" LIKE '%springs%'
            //     and "name" LIKE '%west%'
            //     and "name" LIKE '%baden%'
            //     or (
            //       "name" LIKE '%springs%'
            //       and "name" LIKE '%west%'
            //       and "name" LIKE '%baden%'
            //     )
            //   )
            ::where('country_id', $country->id)
            ->where(function ($query) use ($pattern, $unUmlautedPattern) {
                $patterns = explode(' ', $pattern);
                foreach ($patterns as $pattern) {
                    $query->where('name', 'LIKE', '%' . $pattern . '%');
                }
                $query->orWhere(function ($query) use ($unUmlautedPattern) {
                    $unUmlautedPatterns = explode(' ', $unUmlautedPattern);
                    foreach ($unUmlautedPatterns as $unUmlautedPattern) {
                        $query->where('name', 'LIKE', '%' . $unUmlautedPattern . '%');
                    }
                });
            })
            ->with(['country', 'region'])
            ->orderBy('name', 'asc')
            ->limit(1000)
            ->get(['id', 'name', 'country_id', 'region_id']);
        $locations = collect();
        foreach ($matches as $match) {
            $locations->push($match->location());
        }
        return $locations;
    }

    public function universities(String $pattern = "")
    {
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

    public function languages(String $pattern = "")
    {
        $matches = Language
            ::where('name', 'LIKE', '%' . $pattern . '%')
            ->orWhere('code', 'LIKE', $pattern)
            ->orderBy('name', 'asc')
            ->get();
        return $matches;
    }

    public function version()
    {
        $currentHead = trim(substr(file_get_contents('../.git/HEAD'), 4));
        $branch = str_replace('refs/heads/', '', $currentHead);
        $commit = trim(file_get_contents(sprintf('../.git/%s', $currentHead)));
        return ["branch" => $branch, "commit" => $commit];
    }
}