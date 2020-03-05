<?php

use App\Policies\UserPolicy;
use App\User;
use App\Conference;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\HtmlString;

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

Route::get('/test', function () {
    $mail = new MailMessage();
    $notificationData = DatabaseNotification::all()->first()->data;
    if (isset($notificationData['greeting'])) {
        $greeting = $notificationData['greeting'];
    } else {
        $greeting = null;
    }
    if (isset($notificationData['subject'])) {
        $subject = $notificationData['subject'];
    } else {
        $subject = null;
    }
    if (isset($notificationData['salutation'])) {
        $salutation = $notificationData['salutation'];
        $salutation = new HtmlString(str_replace("\n", "<br>", $salutation));
    } else {
        $salutation = null;
    }
    $mail->greeting($greeting);
    $mail->subject($subject);
    $mail->salutation($salutation);
    collect($notificationData['elements'])->each(function ($element) use (&$mail) {
        $data = new HtmlString(str_replace("\n", "<br>", $element['data']));
        switch ($element['type']) {
            case 'text':
                $mail->line($data);
                break;
            case 'title':
                $mail->line($data);
                break;
            case 'action':
                $mail->action($element['data']['caption'], $element['data']['url']);
                break;
        }
    });
    return $mail;
});

// Landing
Route::get('/', function () {
    return redirect("/conference");
});

Route::get('/conferences', function () {
    return redirect("/conference");
});

// Auth routes
// Route::get('register', 'Auth\RegisterController@index')->name('register');
Route::view('register', 'auth.register')->name('register.show');
Auth::routes(['register' => false]);


Route::group(['middleware' => ['auth']], function () {

    Route::get('conference', 'ConferenceController@showIndex')->middleware("can:viewAny,App\Conference")->name('conference.showIndex');
    Route::get('job', 'JobController@showIndex')->middleware("can:viewAny,App\Job")->name('job.showIndex');
    Route::get('conference/{conference}', 'ConferenceController@showModel')->middleware("can:view,conference")->name('conference.showModel');

    Route::get('user', 'UserController@showIndex')->middleware("can:viewAny,App\User")->name('user.showIndex');
    Route::get('user/{user}/edit', 'UserController@showEdit')->middleware("can:update,user")->name('user.showEdit');
});