<?php

use Illuminate\Http\Request;
use App\Http\Resources\Locations;
use App\Http\Resources\Universities;
use App\Http\Resources\Languages;
use App\Http\Resources\Degrees;
use App\Http\Resources\Shirts;

use App\User;
use App\City;
use App\University;
use App\Language;
use App\Degree;
use App\Shirt;

use Illuminate\Database\Eloquent\Collection;
use PharIo\Manifest\Email;
use Illuminate\Auth\Access\Gate;
use App\Http\Resources\Users;
use App\Http\Resources\Timezones;
use App\Timezone;
use App\Conference;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function () {

    //// GUEST ////
    //// Search ////
    Route::prefix('search')->group(function () {
        Route::get('location/{pattern}', function ($pattern) {
            $unUmlautedPattern = strtr($pattern, ['Ä' => 'A', 'Ü' => 'U', 'Ö' => 'O', 'ä' => 'a', 'ü' => 'u', 'ö' => 'o', 'ß' => 'B']);
            $matches = City::where('name', 'LIKE', $pattern . '%')->orWhere('name', 'LIKE', $unUmlautedPattern . '%')->with(['country', 'region'])->orderBy('name', 'asc')->get(['id', 'name', 'country_id', 'region_id']);
            $locations = collect();
            foreach ($matches as $match) {
                $locations->push($match->location());
            }
            return new Locations($locations);
        });
        Route::get('university/{pattern}', function ($pattern) {
            $patterns = preg_split("/\ |\-|,|;/", $pattern);
            $query = University::where('name', 'LIKE', '%' . $pattern . '%')->orWhere('url', 'LIKE', '%' . $pattern . '%');
            foreach ($patterns as $item) {
                $query = $query->where('name', 'LIKE', '%' . $item . '%');
                $query = $query->orWhere('url', 'LIKE', '%' . $item . '%');
            }
            $matches = $query->orderBy('name', 'asc')->get();
            return new Universities($matches);
        });
        Route::get('language/{pattern}', function ($pattern) {
            $matches = Language::where('name', 'LIKE', '%' . $pattern . '%')->orWhere('code', 'LIKE', $pattern)->orderBy('name', 'asc')->get();
            return new Languages($matches);
        });
    });
    //// Search ////

    Route::get('/degree', function () {
        return new Degrees(Degree::all());
    });

    Route::get('/shirt', function () {
        return new Shirts(Shirt::all());
    });

    Route::get('/timezone', function () {
        return new Timezones(Timezone::all());
    });

    Route::get('email/exists/{email}', function ($email) {
        $emailExists = User::where('email', $email)->get()->count() == 1;
        if ($emailExists) {
            return response()->json(['result' => true]);
        } else {
            return response()->json(['result' => false]);
        };
    });


    Route::post('register', 'Auth\RegisterController@create')->name('register.create');
    //// GUEST ////



    //// AUTHENTICATED ////
    Route::group(['middleware' => ['auth:api']], function () {

        Route::get('user/self', function () {
            return User::with(['permissions', 'timezone'])->find(auth()->user()->id);
        });
        Route::get('conference/{key}', function ($key) {
            return Conference::where('key', $key)->first();
        });
        Route::resource('user', 'UserApiController', [
            'only' => ['index', 'show', 'update', 'destroy']
        ]);
    });
    //// AUTHENTICATED ////

});