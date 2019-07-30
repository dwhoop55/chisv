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
use App\Http\Requests\UserRequest;

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
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(UserRequest $request)
    {
        $validated = $request->validated();

        $userData = [
            'firstname' => $validated['firstname'],
            'lastname' => $validated['lastname'],
            'email' => $validated['email'],
            'city_id' => json_decode($validated['location'])->city->id,
            'shirt_id' => $validated['shirt_id'],
            'degree_id' => $validated['degree_id'],
            'past_conferences' => $validated['past_conferences'],
            'past_conferences_sv' => $validated['past_conferences_sv'],
            'password' => Hash::make($validated['password']),
        ];

        $university = json_decode($validated['university']);
        if ($university->id) {
            $userData['university_id'] = $university->id;
        } else {
            $userData['university_fallback'] = $university->name;
        }

        $user = new User($userData);
        // Required to have an id on the user, for setting language references
        $user->save();

        // Add languages
        $languages = json_decode($validated['languages']);
        foreach ($languages as $language) {
            $user->languages()->attach($language->id);
        }

        event(new Registered($user));

        auth()->guard()->login($user);

        return redirect(route('home'));
    }


    public function index()
    {
        $degrees = Degree::all();
        $shirts = Shirt::all();
        return view('auth.register', compact('degrees', 'shirts'));
    }
}