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

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login.show');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::get('loginAs', 'MiscController@loginAs')->name('loginAs')->middleware('auth');

Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');



// Return our SPA
Route::get('/{any}', function () {
    return view('layouts.app');
})->middleware('auth')->where('any', '.*');
