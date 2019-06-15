<?php

use Illuminate\Http\Request;
use App\Http\Resources\Locations;
use App\Http\Resources\Universities;
use App\City;
use App\University;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/city/search/{pattern}', function ($pattern) {
    $matches = City::where('name', 'LIKE', '%' . $pattern . '%')->with(['country', 'region'])->orderBy('name', 'asc')->get(['id', 'name', 'country_id', 'region_id']);
    $locations = collect();
    foreach ($matches as $match) {
        $locations->push($match->location());
    }
    return new Locations($locations);
});

Route::get('/university/search/{pattern}', function ($pattern) {
    $matches = University::where('name', 'LIKE', '%' . $pattern . '%')->orWhere('url', 'LIKE', '%' . $pattern . '%')->orderBy('name', 'asc')->get();
    return new Universities($matches);
});
