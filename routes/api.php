<?php

use App\User;
use App\City;
use App\Country;
use App\University;
use App\Language;
use App\Degree;
use App\Locale;
use App\Shirt;

use App\Timezone;
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
    //// Search ////
    Route::get('/country', function () {
        return Country::all();
    });;
    Route::get('country/{country}/city/{pattern?}', function (Country $country, $pattern = "") {
        $pattern = trim($pattern);
        $unUmlautedPattern = strtr($pattern, ['Ä' => 'A', 'Ü' => 'U', 'Ö' => 'O', 'ä' => 'a', 'ü' => 'u', 'ö' => 'o', 'ß' => 'B']);
        $matches = City
            // Example:
            //             where
            //   "country_id" = 233
            //   and (
            //     "name" LIKE '%springs%'
            //     and "name" LIKE '%west%'
            //     and "name" LIKE '%baden%'
            //     or (
            //       "name" LIKE '%springs%'
            //       and "name" LIKE '%west%'
            //       and "name" LIKE '%baden%'
            //     )
            //   )
            ::where('country_id', $country->id)
            ->where(function ($query) use ($pattern, $unUmlautedPattern) {
                $patterns = explode(' ', $pattern);
                foreach ($patterns as $pattern) {
                    $query->where('name', 'LIKE', '%' . $pattern . '%');
                }
                $query->orWhere(function ($query) use ($unUmlautedPattern) {
                    $unUmlautedPatterns = explode(' ', $unUmlautedPattern);
                    foreach ($unUmlautedPatterns as $unUmlautedPattern) {
                        $query->where('name', 'LIKE', '%' . $unUmlautedPattern . '%');
                    }
                });
            })
            ->with(['country', 'region'])
            ->orderBy('name', 'asc')
            ->limit(1000)
            ->get(['id', 'name', 'country_id', 'region_id']);
        $locations = collect();
        foreach ($matches as $match) {
            $locations->push($match->location());
        }
        return $locations;
    });
    Route::get('university/name/{pattern}', function ($pattern) {
        $patterns = preg_split("/\ |\-|,|;/", $pattern);
        $query = University::where('name', 'LIKE', '%' . $pattern . '%')->orWhere('url', 'LIKE', '%' . $pattern . '%');
        foreach ($patterns as $item) {
            $query = $query->where('name', 'LIKE', '%' . $item . '%');
            $query = $query->orWhere('url', 'LIKE', '%' . $item . '%');
        }
        $matches = $query->orderBy('name', 'asc')->get();
        return $matches;
    });
    Route::get('language/name/{pattern}', function ($pattern) {
        $matches = Language::where('name', 'LIKE', '%' . $pattern . '%')->orWhere('code', 'LIKE', $pattern)->orderBy('name', 'asc')->get();
        return $matches;
    });

    Route::get('/degree', function () {
        return Degree::all();
    });

    Route::get('/shirt', function () {
        return Shirt::all();
    });

    Route::get('/timezone', function () {
        return Timezone::all();
    });

    Route::get('/locale', function () {
        return Locale::all();
    });

    Route::get('email/exists/{email}', function ($email) {
        $emailExists = User::where('email', $email)->get()->count() == 1;
        if ($emailExists) {
            return response()->json(['result' => true]);
        } else {
            return response()->json(['result' => false]);
        };
    });


    Route::post('register', 'Auth\RegisterController@create')->name('register.create');

    Route::get('version', function () {
        $currentHead = trim(substr(file_get_contents('../.git/HEAD'), 4));
        $branch = str_replace('refs/heads/', '', $currentHead);
        $commit = trim(file_get_contents(sprintf('../.git/%s', $currentHead)));
        return ["branch" => $branch, "commit" => $commit];
    });

    Route::get('conference/preview', 'ConferenceController@indexPreview')
        ->name('conference.preview');
    //// GUEST ////



    //// AUTHENTICATED ////
    Route::group(['middleware' => ['auth:api']], function () {

        // Custom posts (may overwrite ressource routes from below)
        Route::post('logout', function () {
            return auth()->user();
        });
        Route::post('conference/{conference}/notification', 'ConferenceController@postNotification')
            ->name('conference.postNotification')
            ->middleware("can:postNotification,conference");
        Route::post('conference/{conference}/task', 'ConferenceController@importTasks')
            ->name('conference.importTask')
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
        Route::delete('conference/{conference}/tasks/{date}', 'ConferenceController@deleteAllTasks')
            ->name('conference.deleteAllTasks')
            ->middleware("can:deleteTask,conference");

        // Custom gets (may overwrite ressource routes from below)
        // Route::get('notification/unread', 'NotificationController@numberUnread')
        //     ->middleware("can:viewAny,Illuminate\Notifications\DatabaseNotification")
        //     ->name('notification.unread');
        Route::get('user/self', 'UserController@showSelf')
            ->middleware("can:viewSelf,App\User")
            ->name('user.self');
        Route::get('conference/{conference}/task/day', 'ConferenceController@taskDays')
            ->middleware("can:viewAny,App\Task")
            ->name('conference.taskDays');
        Route::get('conference/{conference}/task', 'ConferenceController@tasks')
            ->middleware("can:viewAny,App\Task")
            ->name('conference.tasks');
        Route::get('conference/{conference}/assignment', 'ConferenceController@assignments')
            ->middleware("can:viewAssignments,conference")
            ->name('conference.assignments');
        Route::get('conference/{conference}/enrollment', 'ConferenceController@enrollment')
            ->name('conference.enrollment');
        Route::get('conference/{conference}/sv', 'ConferenceController@svs')
            ->middleware("can:viewUsers,conference")
            ->name('conference.svs');
        Route::get('conference/{conference}/sv_for_task_assignment/{task}', 'ConferenceController@svsForTaskAssignment')
            ->middleware("can:viewUsersForTaskAssignment,conference")
            ->name('conference.svs');
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
            ->name('user.bids');
        Route::get('conference/{conference}/destination', 'ConferenceController@destinations')
            ->middleware("can:viewDestinations,conference")
            ->name('conference.destinations');

        // // Determine if a user has s specific role
        // Route::get('has_permission/{role}/{conference?}/{state?}', function (Role $role, Conference $conference = null, State $state = null) {
        //     return ["result" => auth()->user()->hasPermission($role, $conference, $state)];
        // });

        // Determine if a user can perform a certain action
        Route::get('can/{ability}/{model}/{id?}/{onModel?}/{onId?}', function ($ability, $model, $id = null, $onModel = null, $onId = null) {
            $class = app("App\\" . $model);
            if ($onModel) $onClass = app("App\\" . $onModel);
            $user = auth()->user();

            // These are the possible cases
            // The if mess below has numbers
            // from which case the rule came from
            //1 createForConference Task    1       Conference  1
            //2 createForConference Task    1       Conference  null
            //3 createForConference Task    null    Conference  null
            //4 createForConference Task    null    Conference  1
            //5 createForConference Task    null    null        null
            //6 createForConference Task    1       null        null

            if ($model && $id > 0 && $onModel && $onModel != 'null' && $onId > 0) { // 1
                $instance = $class::find($id);
                $onInstance = $onClass::find($onId);
                $result = $user->can($ability, [$instance, $onInstance]);
            } else if ($model && $id > 0 && $onModel && $onModel != 'null' && (!$onId || $onId == 'null')) { // 2
                $instance = $class::find($id);
                $result = $user->can($ability, [$instance, $onClass]);
            } else if ($model && (!$id || $id == 'null') && $onModel && $onModel != 'null' && (!$onId || $onId == 'null')) { // 3
                $result = $user->can($ability, [$class, $onClass]);
            } else if ($model && (!$id || $id == 'null') && $onModel && $onModel != 'null' && $onId > 0) { // 4
                $onInstance = $onClass::find($onId);
                $result = $user->can($ability, [$class, $onInstance]);
            } else if ($model && (!$id || $id == 'null') && (!$onModel || $onModel == 'null') && (!$onId || $onId == 'null')) { // 5
                $result = $user->can($ability, $class);
            } else if ($model && $id > 0 && (!$onModel || $onModel == 'null') && (!$onId || $onId == 'null')) { // 6
                $instance = $class::find($id);
                $result = $user->can($ability, $instance);
            }

            return ["result" => $result];
        });

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
        Route::resource('enrollment_form', 'EnrollmentFormController', [
            'only' => ['show']
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
            'only' => ['index', 'show', 'update', 'destroy'],
            'parameters' => ['notification' => 'database_notification']
        ]);
        Route::resource('calendar_event', 'CalendarEventController', [
            'only' => ['index'],
        ]);
        Route::resource('faq', 'FaqController', [
            'only' => ['index', 'show'],
        ]);
    });
    //// AUTHENTICATED ////

});