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


// Authentication Web Routes
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');


// Route everything else to Vue
Route::get('{any?}', function () {
    return view('index');
})->where('any', '.*');



// // Landing
// Route::get('/', function () {
//     return redirect('/home');
// });
// Route::get('home', 'HomeController@index')->name('home');

// // Auth routes
// Route::get('register', 'Auth\RegisterController@index')->name('register');
// Auth::routes(['register' => false]);


// Route::group(['middleware' => ['auth']], function () {
//     Route::resource('conference', 'ConferenceController', [
//         // 'only' => ['index', 'show', 'edit', 'create']
//         'only' => ['index', 'show', 'edit', 'create', 'update', 'destroy']
//     ]);
//     Route::resource('user', 'UserController', [
//         'only' => ['index', 'show', 'edit']
//     ]);

//     Route::post('conference/{conference}/enroll', 'ConferenceController@enroll')->name('conference.enroll');
//     Route::post('conference/{conference}/unenroll', 'ConferenceController@unenroll')->name('conference.unenroll');
// });