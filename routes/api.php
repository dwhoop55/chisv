<?php

use Illuminate\Http\Request;
use App\Http\Resources\Locations;
use App\Http\Resources\Universities;
use App\Http\Resources\Languages;
use App\Http\Resources\Degrees;
use App\Http\Resources\Shirts;

use App\User;
use App\City;
use App\University;
use App\Language;
use App\Degree;
use App\Shirt;

use Illuminate\Database\Eloquent\Collection;
use PharIo\Manifest\Email;
use App\Http\Resources\Users;
use App\Http\Resources\Timezones;
use App\Timezone;
use App\Conference;
use App\Role;
use App\State;

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
    Route::prefix('search')->group(function () {
        Route::get('location/{pattern}', function ($pattern) {
            $unUmlautedPattern = strtr($pattern, ['Ä' => 'A', 'Ü' => 'U', 'Ö' => 'O', 'ä' => 'a', 'ü' => 'u', 'ö' => 'o', 'ß' => 'B']);
            $matches = City::where('name', 'LIKE', $pattern . '%')->orWhere('name', 'LIKE', $unUmlautedPattern . '%')->with(['country', 'region'])->orderBy('name', 'asc')->get(['id', 'name', 'country_id', 'region_id']);
            $locations = collect();
            foreach ($matches as $match) {
                $locations->push($match->location());
            }
            return new Locations($locations);
        });
        Route::get('university/{pattern}', function ($pattern) {
            $patterns = preg_split("/\ |\-|,|;/", $pattern);
            $query = University::where('name', 'LIKE', '%' . $pattern . '%')->orWhere('url', 'LIKE', '%' . $pattern . '%');
            foreach ($patterns as $item) {
                $query = $query->where('name', 'LIKE', '%' . $item . '%');
                $query = $query->orWhere('url', 'LIKE', '%' . $item . '%');
            }
            $matches = $query->orderBy('name', 'asc')->get();
            return new Universities($matches);
        });
        Route::get('language/{pattern}', function ($pattern) {
            $matches = Language::where('name', 'LIKE', '%' . $pattern . '%')->orWhere('code', 'LIKE', $pattern)->orderBy('name', 'asc')->get();
            return new Languages($matches);
        });
    });
    //// Search ////

    Route::get('/degree', function () {
        return new Degrees(Degree::all());
    });

    Route::get('/shirt', function () {
        return new Shirts(Shirt::all());
    });

    Route::get('/timezone', function () {
        return new Timezones(Timezone::all());
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
    //// GUEST ////



    //// AUTHENTICATED ////
    Route::group(['middleware' => ['auth:api']], function () {

        // Custom posts (may overwrite ressource routes from below)
        Route::post('conference/{conference}/enroll/{user?}', 'ConferenceController@enroll')
            ->middleware("can:enroll,conference,user")
            ->name('conference.enroll');
        Route::post('conference/{conference}/unenroll/{user?}', 'ConferenceController@unenroll')
            ->middleware("can:unenroll,conference,user")
            ->name('conference.unenroll');
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

        // Custom gets (may overwrite ressource routes from below)
        Route::get('conference/{conference}/task/day', 'ConferenceController@taskDays')
            ->middleware("can:viewAny,App\Task")
            ->name('conference.taskDays');
        Route::get('conference/{conference}/task', 'ConferenceController@task')
            ->middleware("can:viewAny,App\Task")
            ->name('conference.task');
        Route::get('conference/{conference}/enrollment', 'ConferenceController@enrollment')
            ->name('conference.enrollment');
        Route::get('conference/{conference}/sv', 'ConferenceController@sv')
            ->middleware("can:viewUsers,conference")
            ->name('conference.sv');
        Route::get('conference/{conference}/sv/count', function (Conference $conference) {
            return [
                "result" => $conference
                    ->permissions(Role::byName('sv'))
                    ->where('state_id', State::byName('accepted')->id)
                    ->count(),
                "message" => null
            ];
        })->name('conference.svCount');
        Route::get('enrollment_form/template', 'EnrollmentFormController@indexTemplates')
            ->middleware("can:viewTemplates,App\EnrollmentForm")
            ->name('enrollmentForm.templates');

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
        ]);
        Route::resource('task', 'TaskController', [
            'only' => ['store', 'update', 'destroy']
        ]);
        Route::resource('bid', 'BidController', [
            'only' => ['store', 'update']
        ]);
    });
    //// AUTHENTICATED ////

});