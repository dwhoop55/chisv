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
Route::prefix('register')->group(function () {
    Route::get('', 'Auth\RegisterController@index')->name('register');
    Route::post('', 'Auth\RegisterController@create')->name('register.create');
});

Route::get('home', 'HomeController@index')->name('home.index');
Route::resource('conference', 'ConferenceController');