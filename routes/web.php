<?php

use App\Policies\UserPolicy;
use App\User;
use App\Conference;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Landing
Route::get('/', function () {
    return redirect("/conference");
});

Route::get('/conferences', function () {
    return redirect("/conference");
});

// Auth routes
// Route::get('register', 'Auth\RegisterController@index')->name('register');
Route::view('register', 'auth.register')->name('register.show');
Auth::routes(['register' => false]);


Route::group(['middleware' => ['auth']], function () {

    Route::get('conference', 'ConferenceController@showIndex')->middleware("can:viewAny,App\Conference")->name('conference.showIndex');
    Route::get('job', 'JobController@showIndex')->middleware("can:viewAny,App\Job")->name('job.showIndex');
    Route::get('conference/{conference}', 'ConferenceController@showModel')->middleware("can:view,conference")->name('conference.showModel');

    Route::get('user', 'UserController@showIndex')->middleware("can:viewAny,App\User")->name('user.showIndex');
    Route::get('user/{user}/edit', 'UserController@showEdit')->middleware("can:update,user")->name('user.showEdit');
});