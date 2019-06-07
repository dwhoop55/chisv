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
        return redirect(route('register.index.one'));
    })->name('register');
    Route::get('name', 'Auth\RegisterController@indexOne')->name('register.index.one');
    Route::post('name', 'Auth\RegisterController@storeOne')->name('register.store.one');
    Route::get('chooseUniversity', 'Auth\RegisterController@indexTwo')->name('register.index.two');
    Route::post('chooseUniversity', 'Auth\RegisterController@storeTwo')->name('register.store.two');
    Route::get('searchUniversity', 'Auth\RegisterController@indexThree')->name('register.index.three');
    Route::post('searchUniversity', 'Auth\RegisterController@storeThree')->name('register.store.three');
    Route::get('password', 'Auth\RegisterController@indexFour')->name('register.index.four');
    Route::post('password', 'Auth\RegisterController@storeFour')->name('register.store.four');
});

Route::get('home', 'HomeController@index')->name('home.index');
Route::resource('conference', 'ConferenceController');