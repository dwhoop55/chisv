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

Auth::routes(['register' => false]);
Route::prefix('register')->group(function () {
    Route::get('', function () {
        return redirect(route('registerOne'));
    })->name('register');
    Route::get('1', 'Auth\RegisterController@indexOne')->name('registerOne');
    Route::get('2', 'Auth\RegisterController@indexTwo')->name('registerTwo');
    Route::get('3', 'Auth\RegisterController@indexThree')->name('registerThree');
});

Route::get('home', 'HomeController@index');
Route::resource('conference', 'ConferenceController');