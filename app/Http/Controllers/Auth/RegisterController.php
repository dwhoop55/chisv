<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

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

    use RegistersUsers;

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
     * Create a new user instance after a valid registration.
     *
     * @param  Request  $request
     * @return \App\User
     */
    protected function create(Request $request)
    {
        $data = $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'languageIds' => ['required', 'array', 'exists:languages,id'],
            'cityId' => ['required', 'integer', 'exists:cities,id'],
            'universityId' => ['integer', 'exists:universities,id'],
            'universityString' => ['string'],
            'degreeId' => ['required', 'integer', 'exists:degrees,id'],
            'shirtId' => ['required', 'integer', 'exists:shirts,id'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'pastConferences' => ['string'],
            'pastConferencesSV' => ['string'],
        ]);

        $userData = [
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'city_id' => $data['cityId'],
            'shirt_id' => $data['shirtId'],
            'degree_id' => $data['degreeId'],
            'past_conferences' => $data['pastConferences'],
            'past_conferences_sv' => $data['pastConferencesSV'],
            'password' => Hash::make($data['password']),
        ];


        if ($data['universityId']) {
            $userData['university_id'] = $data['universityId'];
        } else {
            $userData['university_fallback'] = $data['universityString'];
        }

        $user = new User($userData);
        // Required to have an id on the user, for setting language references
        $user->save();

        // Add languages
        foreach ($data['languageIds'] as $lang) {
            $user->languages()->attach($lang);
        }

        Auth::login($user);
        return $user;
    }

    public function index()
    {
        return view('auth.register');
    }
}