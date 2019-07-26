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
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],

            'languages' => ['required', 'json'],
            'languages.*.id' => ['required', 'integer', 'exists:languages,id'],

            'location' => ['required', 'json'],
            'location.city.id' => ['required', 'integer', 'exists:cities,id'],

            'university' => ['required', 'json'],
            'university.id' => ['exists:universities,id'],

            'degreeId' => ['required', 'integer', 'exists:degrees,id'],
            'shirtId' => ['required', 'integer', 'exists:shirts,id'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'pastConferences' => ['string'],
            'pastConferencesSV' => ['string'],
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validator($request->all())->validate();

        $userData = [
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'email' => $request['email'],
            'city_id' => $request['cityId'],
            'shirt_id' => $request['shirtId'],
            'degree_id' => $request['degreeId'],
            'past_conferences' => $request['pastConferences'],
            'past_conferences_sv' => $request['pastConferencesSV'],
            'password' => Hash::make($request['password']),
        ];


        if ($request['universityId']) {
            $userData['university_id'] = $request['universityId'];
        } else {
            $userData['university_fallback'] = $request['universityString'];
        }

        $user = new User($userData);
        // Required to have an id on the user, for setting language references
        $user->save();

        // Add languages
        foreach ($request['languageIds'] as $lang) {
            $user->languages()->attach($lang);
        }

        event(new Registered($user));

        \Auth::guard()->login($user);

        return response()->json([
            'status' => true,
            'user' => $user,
        ], 201);
    }


    public function index()
    {
        $degrees = Degree::all();
        $shirts = Shirt::all();
        return view('auth.register', compact('degrees', 'shirts'));
    }
}