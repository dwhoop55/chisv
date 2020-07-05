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

// Auth routes
Route::view('register', 'auth.register')->middleware('guest')->name('register.show');
Auth::routes(['register' => false]);
Route::get('loginAs', 'MiscController@loginAs')->middleware('auth');

// Return our SPA
Route::get('/{any}', function () {
    return view('layouts.app');
})->middleware('auth')->where('any', '.*');
