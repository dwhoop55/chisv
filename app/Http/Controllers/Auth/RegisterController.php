<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
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
        ]);

        $user = [
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'city_id' => $data['cityId'],
            'shirt_id' => $data['shirtId'],
            'degree_id' => $data['degreeId'],
            'password' => Hash::make($data['password']),
        ];

        if ($data['universityId']) {
            $user['university_id'] = $data['universityId'];
        } else {
            $user['university_fallback'] = $data['universityString'];
        }

        // Add languages
        // add past / pastSV
        // dd($user);
        return User::create($user);
        // [
        //     'firstname' => $data['firstname'],
        //     'lastname' => $data['lastname'],
        //     'email' => $data['email'],
        //     'city_id' => $data['cityId'],
        //     'university_id' => $data['universityId'],
        //     'shirt_id' => $data['shirtId'],
        //     'degree_id' => $data['degree_id'],
        //     'password' => Hash::make($data['password']),
        // ]);
    }

    public function index()
    {
        return view('auth.register');
    }
}