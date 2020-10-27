<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\UserController;
use App\Http\Requests\UserCreateRequest;
use Illuminate\Http\JsonResponse;

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
     * @group User
     * Create a new user
     * 
     * @bodyParam firstname string required The user's first name Example: Jacob
     * @bodyParam lastname string required The user's last name Example: Smith
     * @bodyParam email string required The user's email Example: jacob@example.com
     * @bodyParam languages array<[Language](#get-all-languages-matching-a-pattern)> An array of languages
     * @bodyParam languages.*.id int required A [language's](#get-all-languages-matching-a-pattern) id Example: 23
     * @bodyParam location [Location](#get-all-locations-for-a-country-by-city-name) required The users location by city name
     * @bodyParam location.country.id int required The location's country id Example: 82
     * @bodyParam location.country.name string The location's country name Example: Germany
     * @bodyParam location.region.id int The location's region id Example: 1268
     * @bodyParam location.region.name string The location's region name Example: Nordrhein-Westfalen
     * @bodyParam location.city.id int The location's city id Example: 12850
     * @bodyParam location.city.name string The location's city name Example: Aachen
     * @bodyParam university.id int The [university's](#get-all-universities-matching-a-pattern) id Example: 4044
     * @bodyParam university.name string The fallback university's name if no id used (see above) Example: RWTH Aachen
     * @bodyParam degree_id int required The user's [degree](#get-all-degrees) Example: 2
     * @bodyParam shirt_id int required The user's [shirt](#get-all-t-shirts) Example: 3
     * @bodyParam locale_id int required The user's [locale](#get-all-locales) Example: 51
     * @bodyParam past_conferences array<string> The user's past attended conferences as array
     * @bodyParam past_conferences.* string A user's past attended conference Example: CHI 2019
     * @bodyParam past_conferences_sv array<string> The user's past attended conferences as SV as array
     * @bodyParam past_conferences_sv.* string A user's past attended conference as SV Example: CHI 2019
     * @bodyParam password string The user's password Example: secret
     * @bodyParam password_confirmation string The user's password Example: secret
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
            'locale_id',
            'degree_id',
            'shirt_id',
            'past_conferences',
            'past_conferences_sv',
            'password'
        );

        $data['firstname'] = ucWords(strtolower($data['firstname']));
        $data['lastname'] = ucWords(strtolower($data['lastname']));
        $data['password'] = Hash::make($data['password']);
        $data['country_id'] = $request['location']['country']['id'];
        $data['region_id'] = $request['location']['region']['id'] ?? null;
        $data['city_id'] = $request['location']['city']['id'] ?? null;

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

        auth()->login($user);

        $controller = new UserController();
        return $request->wantsJson()
            ? new JsonResponse($controller->showSelf($user)->toArray(), 201)
            : redirect()->intended('/');
    }
}