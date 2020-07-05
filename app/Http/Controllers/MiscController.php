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
use Illuminate\Support\Facades\Log;

/**
 * Various methods that creating a controller for would be too much
 */
class MiscController extends Controller
{

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
     * Get all locales
     * 
     * @responseFile responses/locales.get.json
     * 
     */
    public function locales()
    {
        return Locale::all();
    }

    /**
     * @group Generic Resources
     * 
     * Get all timezones
     * 
     */
    public function timezones()
    {
        return Timezone::all();
    }

    /**
     * @group Generic Resources
     * 
     * Get all T-Shirts
     * 
     */
    public function shirts()
    {
        return Shirt::all();
    }

    /**
     * @group Generic Resources
     * 
     * Get all degrees
     * 
     */
    public function degrees()
    {
        return Degree::all();
    }

    /**
     * @group Generic Resources
     * 
     * Get all countries
     * 
     * @responseFile responses/countries.get.json
     * 
     */
    public function countries()
    {
        return Country::all();
    }

    /**
     * @group Generic Resources
     * 
     * Get all locations for a country by city name
     * 
     * @urlParam country required The country the city is in Example: 82
     * @urlParam pattern The name of the city Example: Aachen
     * 
     */
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

    /**
     * @group Generic Resources
     * 
     * Get all universities matching a pattern
     * 
     * @urlParam pattern The pattern to match Example: Aachen
     * 
     */
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

    /**
     * @group Generic Resources
     * 
     * Get all languages matching a pattern
     * 
     * @urlParam pattern string The pattern to match Example: Ger
     * 
     */
    public function languages(String $pattern = "")
    {
        $matches = Language
            ::where('name', 'LIKE', '%' . $pattern . '%')
            ->orWhere('code', 'LIKE', $pattern)
            ->orderBy('name', 'asc')
            ->get();
        return $matches;
    }

    /**
     * @authenticated
     * @group Generic Resources
     * 
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
