<?php

namespace App\Http\Controllers\Auth;

use Auth, Session;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Client;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use App\Models\ClientProperty;
use App\Http\Controllers\Controller;
use App\Models\UserManagement\UserLoginHistory;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function username()
    {
        return 'login';
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->route('dashboard');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'login' => 'required|min:2|max:30',
            'password' => 'required|min:6|max:20'
        ]);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = [
            'password' => $request->input('password')
        ];
        $login = $request->input('login');

        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $login;
        } else {
            $credentials['username'] = $login;
        }

        if ($this->guard()->attempt($credentials, $request->has('remember'))) {
            $user = user();

            // if ($user->clientGroup->suspended) {
            //     Auth::logout();

            //     return validationError('Your service has been suspended.');
            // }

            $clientPropertyId = $user->client_property_id;
            $clientId = $user->client_id;
            $user->last_login = Carbon::now();
            $user->save();

            $log = new UserLoginHistory();
            $log->user_id = $user->id;
            $log->client_group_id = $user->client_group_id;
            $log->ip = getUserIP();
            $agent = new Agent();
            $log->browser = $agent->browser();
            $log->platform = $agent->platform();
            $log->save();

            Session::put('locked_client_property', $clientPropertyId ? ClientProperty::find($clientPropertyId) : defaultClientProperty());
            Session::put('locked_client', $clientId ? Client::find($clientId) : defaultClient($clientPropertyId));

            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
}
