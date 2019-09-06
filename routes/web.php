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
Route::get('/', 'HomeController@index')->name('home');

// Auth routes
// Route::get('register', 'Auth\RegisterController@index')->name('register');
Route::view('register', 'auth.register')->name('register.show');
Auth::routes(['register' => false]);


Route::group(['middleware' => ['auth']], function () {

    Route::get('conference', 'ConferenceController@showIndex')->middleware("can:viewAny,App\Conference")->name('conference.showIndex');
    // Route::get('conference/create', 'ConferenceController@showCreate')->middleware("can:create,App\Conference")->name('conference.showCreate');
    // Route::get('conference/{conference}/edit', 'ConferenceController@showEdit')->middleware("can:update,conference")->name('conference.showEdit');
    Route::get('conference/{conference}', 'ConferenceController@showModel')->middleware("can:view,conference")->name('conference.showModel');

    Route::get('user', 'UserController@showIndex')->middleware("can:viewAny,App\User")->name('user.showIndex');
    Route::get('user/{user}/edit', 'UserController@showEdit')->middleware("can:update,user")->name('user.showEdit');
});