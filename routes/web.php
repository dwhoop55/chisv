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

// Route::get('/{any}', 'SpaController@index')->where('any', '.*');

Route::get('/', function () {
    return redirect('/home');
});

Auth::routes(['register' => false]);
Route::get('register', 'Auth\RegisterController@index')->name('register');
Route::post('register', 'Auth\RegisterController@create')->name('register.create');

Route::get('home', 'HomeController@index')->name('home');
Route::resource('conference', 'ConferenceController')->middleware('auth');