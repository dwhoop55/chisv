<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Http\Requests\LoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

/**
 * @group Authentication
 */
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Issue a JWT token for a user
     * Call without any existing Bearer token (remove from example). Will issue a JWT token (access_token) via the OAuth API by using the password_grant type.
     * 
     * @bodyParam email string required The user's email Example: admin@chisv.org
     * @bodyParam password string required The user's password Example: secret
     * 
     * @response 200 {
     * "token_type":"Bearer","expires_in":31536000,"access_token":"eyJ0eX...3vE8","refresh_token":"def50...9c2"}
     * 
     * @response 422 {
     * "message":"The given data was invalid.","errors":{"email":["The email field is required."],"password":["The password field is required."]}
     * }
     * 
     */
    public function issueToken(LoginRequest $request)
    {
        $http = new \GuzzleHttp\Client;

        if (App::environment() == "dev" || App::environment() == "development" || App::environment() == "local") {
            $host = "localhost:8001";
        } else {
            $host = "localhost:80";
        }

        $headers = [
            'cache-control' => 'no-cache',
        ];
        $params = [
            'grant_type' => 'password',
            'client_id' => config('app.oauth_client_id') ?? abort(500, "No OAuth client id present. Contact Admins"),
            'client_secret' => config('app.oauth_client_secret') ?? abort(500, "No OAuth client secret
             present. Contact Admins"),
            'username' => $request->email,
            'password' => $request->password,
            'scope' => ''
        ];

        $response = $http->post("http://$host/oauth/token", [
            'headers' => $headers,
            'form_params' => $params
        ]);

        return json_decode((string) $response->getBody(), true);
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        $controller = new UserController();
        return $controller->showSelf($user)->toArray();
    }
}