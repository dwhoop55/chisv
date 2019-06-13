<?php

use Illuminate\Http\Request;
use App\Http\Resources\Locations;
use App\City;

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
    $matches = City::where('name', 'LIKE', '%' . $pattern . '%')->with(['country', 'region'])->get(['id', 'name', 'country_id', 'region_id']);
    $locations = collect();
    foreach ($matches as $match) {
        $locations->push($match->location());
    }
    return new Locations($locations);
});