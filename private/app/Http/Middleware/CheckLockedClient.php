<?php

namespace App\Http\Middleware;

use App\Models\Client;
use App\Models\ClientProperty;
use Closure, Session, Auth, Request;

class CheckLockedClient
{
    public function handle($request, Closure $next)
    {
        if (Auth::guest() || Request::is('logout')) return $next($request);

        if (!Session::has('locked_client_property') || !Session::has('locked_client')) {
            $user               = user();
            $clientPropertyId   = $user->client_property_id;
            $clientId           = $user->client_id;

            Session::put('locked_client_property', $clientPropertyId ? ClientProperty::find($clientPropertyId) : defaultClientProperty());
            Session::put('locked_client', $clientId ? Client::find($clientId) : defaultClient($clientPropertyId));

            if ($user->access_level != 'client') return swalError('Session has expired. Your client access has been changed to ' . Session::get('locked_client')->name . '.');
        }

        return $next($request);
    }
}