<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Degree;
use App\Shirt;
use App\Http\Requests\UserCreateRequest;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(UserCreateRequest $request)
    {

        $data = $request->only(
            'firstname',
            'lastname',
            'email',
            'timezone_id',
            'timezone_id',
            'degree_id',
            'shirt_id',
            'past_conferences',
            'past_conferences_sv',
            'password'
        );

        $data['password'] = Hash::make($data['password']);
        $data['country_id'] = $request['location']['country']['id'];
        $data['region_id'] = $request['location']['region']['id'];
        $data['city_id'] = $request['location']['city']['id'];

        $university = $request['university'];
        if (isset($university['id'])) {
            $data['university_id'] = $university['id'];
        } else {
            $data['university_fallback'] = $university['name'];
        }

        $user = new User($data);
        // Required to have an id on the user, for setting language references
        $user->save();

        // Add languages
        $languages = $request['languages'];
        foreach ($languages as $language) {
            $user->languages()->attach($language['id']);
        }

        event(new Registered($user));

        auth()->guard()->login($user);

        return ["result" => $user, "error" => null];
    }
}