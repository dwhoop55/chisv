<?php

use App\Http\Controllers\MiscController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function () {

    //// GUEST ////
    Route::get('boot', 'MiscController@bootstrapRessources');
    Route::get('country/{country}/city', 'MiscController@citiesInCountry');
    Route::get('university', 'MiscController@universities');

    Route::post('password/forgot', 'Auth\ForgotPasswordController@sendResetLinkEmail')
        ->name('password.forgot');

    Route::get('conference/preview', 'ConferenceController@indexPreview')
        ->name('conference.preview');

    Route::post('login', 'Auth\LoginController@issueToken')->name('issueToken');
    //// GUEST ////



    //// AUTHENTICATED ////
    Route::group(['middleware' => ['auth:api']], function () {

        // Custom posts (may overwrite ressource routes from below)
        Route::post('bid/multi', 'BidController@multiBid')
            ->name('bid.multiBid')
            ->middleware("can:create,App\Bid");
        Route::post('conference/{conference}/notification', 'ConferenceController@postNotification')
            ->name('conference.postNotification')
            ->middleware("can:postNotification,conference");
        Route::post('conference/{conference}/task', 'ConferenceController@importTasks')
            ->name('conference.importTasks')
            ->middleware("can:create,App\Task");
        Route::post('conference/{conference}/enroll/{user?}', 'ConferenceController@enroll')
            ->middleware("can:enroll,conference,user")
            ->name('conference.enroll');
        Route::delete('conference/{conference}/enroll/{user?}', 'ConferenceController@unenroll')
            ->middleware("can:unenroll,conference,user")
            ->name('conference.unenroll');
        Route::post('conference/{conference}/auction/{day}', 'ConferenceController@runAuction')
            ->name('conference.runAuction')
            ->middleware("can:runAuction,conference");
        Route::post('conference/{conference}/lottery', 'ConferenceController@runLottery')
            ->name('conference.runLottery')
            ->middleware("can:runLottery,conference");

        // Custom put (may overwrite ressource routes from below)
        Route::put('conference/{conference}/update_enrollment_form_weights', 'ConferenceController@updateEnrollmentFormWeights')
            ->name('conference.updateEnrollmentFormWeights')
            ->middleware("can:updateEnrollmentFormWeights,conference");
        Route::put('conference/{conference}/reset_enrollments_to_enrolled', 'ConferenceController@resetEnrollmentsToEnrolled')
            ->name('conference.resetEnrollmentsToEnrolled')
            ->middleware("can:updateEnrollment,conference");

        // Custom delete
        Route::delete('conference/{conference}/assignments/{date}', 'ConferenceController@deleteAllAssignments')
            ->name('conference.deleteAllAssignments')
            ->middleware("can:deleteAssignment,conference");
        Route::delete('conference/{conference}/tasks', 'ConferenceController@deleteAllTasks')
            ->name('conference.deleteAllTasks')
            ->middleware("can:deleteTask,conference");

        // Custom gets (may overwrite ressource routes from below)
        Route::get('conference/{conference}/task/day', 'ConferenceController@taskDays')
            ->middleware("can:viewAny,App\Task")
            ->name('conference.taskDays');
        Route::get('conference/{conference}/task', 'ConferenceController@tasks')
            ->middleware("can:viewAny,App\Task")
            ->name('conference.tasks');
        Route::get('conference/{conference}/assignment', 'ConferenceController@assignments')
            ->middleware("can:viewAssignments,conference")
            ->name('conference.assignments');
        Route::get('conference/{conference}/sv', 'ConferenceController@svs')
            ->middleware("can:viewUsers,conference")
            ->name('conference.svs');
        Route::get('conference/{conference}/sv_for_task_assignment/{task}', 'ConferenceController@svsForTaskAssignment')
            ->middleware("can:viewUsersForTaskAssignment,conference")
            ->name('conference.svsForTaskAssignment');
        Route::get('conference/{conference}/sv/count', 'ConferenceController@svsCount')
            ->name('conference.svCount');
        Route::get('enrollment_form/template', 'EnrollmentFormController@indexTemplates')
            ->middleware("can:viewTemplates,App\EnrollmentForm")
            ->name('enrollmentForm.templates');
        Route::get('conference/{conference}/report/{name}', 'ReportController@show')
            ->middleware("can:viewReports,conference")
            ->name('conference.reports');
        Route::get('user/{user}/bid/{conference}', 'UserController@bidsForConference')
            ->middleware("can:viewBidsForConference,user,conference")
            ->name('user.bids.conference');
        Route::get('user/{user}/notification/{conference}', 'UserController@notificationsForConference')
            ->middleware("can:viewNotificationsForConference,user,conference")
            ->name('user.notifications.conference');
        Route::get('conference/{conference}/destination', 'ConferenceController@destinations')
            ->middleware("can:viewDestinations,conference")
            ->name('conference.destinations');


        Route::resource('enrollment_form', 'EnrollmentFormController', [
            'only' => ['update']
        ]);
        Route::resource('user', 'UserController', [
            'only' => ['index', 'show', 'update', 'destroy']
        ]);
        Route::resource('conference', 'ConferenceController', [
            'only' => ['index', 'show', 'update', 'destroy', 'store']
        ]);
        Route::resource('role', 'RoleController', [
            'only' => ['index']
        ]);
        Route::resource('state', 'StateController', [
            'only' => ['index']
        ]);
        Route::resource('permission', 'PermissionController', [
            'only' => ['store', 'destroy', 'update']
        ]);
        Route::resource('image', 'ImageController', [
            'only' => ['store', 'destroy', 'update']
        ]);
        Route::resource('job', 'JobController', [
            'only' => ['index', 'show']
        ])->middleware("throttle:500");
        Route::resource('task', 'TaskController', [
            'only' => ['store', 'update', 'destroy']
        ]);
        Route::resource('bid', 'BidController', [
            'only' => ['store', 'update', 'destroy']
        ]);
        Route::resource('assignment', 'AssignmentController', [
            'only' => ['store', 'update', 'destroy']
        ]);
        Route::resource('notification_template', 'NotificationTemplateController', [
            'only' => ['index', 'store', 'destroy']
        ]);
        Route::resource('notification', 'NotificationController', [
            'only' => ['index', 'show'],
            'parameters' => ['notification' => 'database_notification']
        ]);
        Route::resource('calendar_event', 'CalendarEventController', [
            'only' => ['index'],
        ]);
        Route::resource('faq', 'FaqController', [
            'only' => ['index', 'show', 'update', 'destroy', 'store'],
        ]);
        Route::resource('note', 'NoteController', [
            'only' => ['destroy', 'store'],
        ]);
    });
    //// AUTHENTICATED ////

});