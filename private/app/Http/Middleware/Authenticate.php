<?php

namespace App\Http\Middleware;

use Closure, Config;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate 
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        return $next($request);
    }

    protected function authenticate($request, array $guards)
    {
        if (empty($guards)) {
            return $this->auth->authenticate();
        }
        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                $this->auth->shouldUse($guard);

                if ($guard == 'member-api') {
                    if ($request->client_code) {
                        $client = Client::withoutGlobalScopes(['client-group', 'client-property'])->where('code', $request->client_code)->first();
                    } elseif (isset(\Auth::user()->client_id)) {
                        Config::set('client.id', \Auth::user()->client_id);
                    }
                }

                return;
            }
        }

        throw new AuthenticationException('Unauthenticated.', $guards);
    }
}
