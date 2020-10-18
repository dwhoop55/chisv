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

// Auth routes with cookies
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::get('loginAs', 'MiscController@loginAs')->name('loginAs')->middleware('auth');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.reset');

// Return our SPA
Route::get('/{any}', 'MiscController@showSpa')
    ->name('spa.show')
    // ->middleware('auth')
    ->where('any', '.*');


// This has to be below the SPA route, as we only want to have it so that the
// forgot password email notifications can get the URL by the routes name.
// Otherwise sending emails will fail and one would have to publish all
// internal Laravel notification templates and adjust that there.
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');