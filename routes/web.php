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

Route::get('/', function () {
    return redirect('/home');
});

Auth::routes(['register' => true]);
// Route::get('/register/university', 'RegisterController@')

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('conference', 'ConferenceController');