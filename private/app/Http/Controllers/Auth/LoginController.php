<?php

namespace App\Http\Controllers\Auth;

use Auth, Session, Hash;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\UserLoginHistory;

class LoginController extends Controller
{
    use AuthenticatesUsers;

      public function __construct()
      {
         $this->middleware('guest')->except('logout');
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
              'username' => 'required|min:2|max:30',
              'password' => 'required|min:5|max:20'
          ]);

          if ($this->hasTooManyLoginAttempts($request)) {
              $this->fireLockoutEvent($request);
              return $this->sendLockoutResponse($request);
          }

          $credentials = [
              'password' => $request->input('password')
          ];
          $login = $request->input('username');

          if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
              $credentials['email'] = $login;
          } else {
              $credentials['username'] = $login;
          }

          session(['com' => getResourceName("Master", "Company")::find('DEV')]);

          if ($this->guard()->attempt($credentials, $request->has('remember'))) {
              $user = user();

              $user->last_login = Carbon::now();
              $user->save();

              $log = new UserLoginHistory();
              $log->user_id = $user->id;
              $log->ip = getUserIP();
              $agent = new Agent();
              $log->browser = $agent->browser();
              $log->platform = $agent->platform();
              $log->save();

              session(['user' => $user->getOriginal()]);
              session(['log' => $log->getOriginal()]);


              return $this->sendLoginResponse($request);
          }

          $this->incrementLoginAttempts($request);

          return $this->sendFailedLoginResponse($request);
      }
}
