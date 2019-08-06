<?php

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
    return redirect('/home');
});
Route::get('home', 'HomeController@index')->name('home');

// Auth routes
Auth::routes(['register' => false]);
Route::get('register', 'Auth\RegisterController@index')->name('register');
Route::post('register', 'Auth\RegisterController@create')->name('register.create');


Route::group(['middleware' => ['auth']], function () {
    Route::resource('conference', 'ConferenceController', [
        'only' => ['index', 'show', 'edit', 'create']
    ]);
    Route::resource('user', 'UserController', [
        'only' => ['index', 'show', 'edit']
    ]);

    Route::post('conference/{conference}/enroll', 'ConferenceController@enroll')->name('conference.enroll');
    Route::post('conference/{conference}/unenroll', 'ConferenceController@unenroll')->name('conference.unenroll');
});