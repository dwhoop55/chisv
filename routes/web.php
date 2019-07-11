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

// Resources
Route::resource('conference', 'ConferenceController')->middleware('auth');
Route::resource('user', 'UserController')->middleware('auth');