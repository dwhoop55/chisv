<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\University;
use Illuminate\Support\Collection;

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
            'country_id' => ['required', 'integer'],
            'university_id' => ['required', 'integer'],
            'shirt_id' => ['required', 'integer'],
            'degree_id' => ['required', 'integer'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'country_id' => $data['country_id'],
            'university_id' => $data['university_id'],
            'shirt_id' => $data['shirt_id'],
            'degree_id' => $data['degree_id'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function indexOne()
    {
        return view('auth.registerOne');
    }

    public function storeOne(Request $request)
    {
        $validatedData = $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        // Get universities based on the email and remove the http and www stuff
        $universities = University::byEmail($validatedData['email'])->map(function ($item) {
            $item['shortedUrl'] = preg_replace('#^https?://(www\.)?#', '', rtrim($item['url'], '/'));
            return $item;
        });

        $request->session()->put('firstname', $validatedData['firstname']);
        $request->session()->put('lastname', $validatedData['lastname']);
        $request->session()->put('email', $validatedData['email']);

        // If there are universities based on the email go to the selection
        // If not skip to the search and selection view
        if ($universities->count() > 0) {
            $request->session()->put('universities', $universities);
            $request->session()->put('by', 'email');
            return redirect()->route('register.index.two');
        } else {
            return redirect()->route('register.index.three');
        }
    }

    public function indexTwo()
    {
        $email = session()->get('email');
        $universities = session()->get('universities');
        if (!$email) {
            // Step one has not been completed redirect back
            return redirect()->route('register.index.one');
        } else if (!$universities) {
            // This view is for selecting universities. Need to got to step three
            return redirect()->route('register.index.three');
        }
        return view('auth.registerTwo', ["email" => $email, "universities" => $universities]);
    }

    public function storeTwo(Request $request)
    {
        $validatedData = $request->validate(['university' => 'required']);
        $university = $validatedData['university'];
        if ($university === "none") {
            return redirect()->route('register.index.three');
        } else {
            $request->session()->put('university', $validatedData['university']);
            return redirect()->route('register.index.four');
        }
    }

    public function indexThree()
    {
        $email = session()->get('email');
        if (!$email) {
            // Step one has not been completed redirect back
            return redirect()->route('register.index.one');
        }
        return view('auth.registerThree');
    }

    public function storeThree(Request $request)
    {
        $validatedData = $request->validate(['search' => 'required|min:3|max:20']);
        $universities = University::byPattern($validatedData['search']);

        if ($universities->count() == 0) { // none found
            return redirect()->back()->withErrors(['noResults' => true])->withInput();
        } else {
            // Found one ore more        
            // Get universities based on the email and remove the http and www stuff
            $universities = University::byPattern($validatedData['search'])->map(function ($item) {
                $item['shortedUrl'] = preg_replace('#^https?://(www\.)?#', '', rtrim($item['url'], '/'));
                return $item;
            });
            $request->session()->put('universities', $universities);
            $request->session()->put('by', 'pattern');
            $request->session()->put('search', $validatedData['search']);
            return redirect()->route('register.index.two');
        }
    }
}