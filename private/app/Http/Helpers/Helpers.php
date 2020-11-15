<?php

use App\Models\Client;
use App\Models\ClientGroup;
use App\Models\ClientProperty;
use Illuminate\Support\Facades\Config;


/**
 * Inkombizz | inkombizz@gmail.com | inkombizz.com
 * Make a Response.
 *
 * @param  int  $statusCode
 * @param  string  $status
 * @param  string  $message
 * @param  array|object|null  $data
 * @param  array  $headers
 * @return json
 */
function makeResponse($statusCode, $status, $message, $data = null, $headers = [])
{
    $result = [
        'status_code' => $statusCode,
        'status' => $status == 'pagination' ? 'success' : $status,
        'message' => $message,
        'data' => $data,
    ];

    if ($status == 'pagination') {
        $result = array_merge($result, ['paginator' => [
            'total_records' => (int) $data->total(),
            'total_pages' => (int) $data->lastPage(),
            'current_page' => (int) $data->currentPage(),
            'per_page' => (int) $data->perPage(),
        ]]);
    }

    return response()->json($result, $statusCode, $headers);
}

function prefix($str, $length) {
    return str_pad($str, $length, '0', STR_PAD_LEFT);
}

function getUserIP() {
    $client = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote = $_SERVER['REMOTE_ADDR'];

    if (filter_var($client, FILTER_VALIDATE_IP)) {
        $ip = $client;
    } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
        $ip = $forward;
    } else {
        $ip = $remote;
    }

    return $ip;
}

function swalError($message = 'Validation Error!') {
    while (DB::transactionLevel() > 0) {
        DB::rollBack();
    }

    return redirect()->back()->withInput(request()->except('_token'))->with('swal_error', $message);
}

function user() {
    $user = Auth::user();

    return $user;
}

function lockedClientProperty() {
    return Session::get('locked_client_property');
}

function lockedClient() {
    return Session::get('locked_client');
}

function updateLockedClientProperty($clientProperty) {
    Session::put('locked_client_property', $clientProperty);
    updateLockedClient(defaultClient($clientProperty->id));

    return lockedClientProperty();
}

function updateLockedClient($client) {
    Session::put('locked_client', $client);

    return lockedClient();
}

function clientGroup() {
    $defaultClientGroupId = Config::get('client.group_id');

    if (!$defaultClientGroupId && Config::get('client.property_id') !== false) {
        $defaultClientGroupId = clientProperty()->client_group_id;
    }
    if (!$defaultClientGroupId && Config::get('client.id') !== false) {
        $defaultClientGroupId = client()->client_group_id;
    }

    if ($defaultClientGroupId !== false) {
        return ClientGroup::find($defaultClientGroupId);
    }

    $user = user();

    return $user && $user->client_group_id ? $user->clientGroup : null;
}

function clientProperty() {
    $defaultClientPropertyId = Config::get('client.property_id');

    if (!$defaultClientPropertyId && Config::get('client.id') !== false) {
        $defaultClientPropertyId = client()->client_property_id;
    }

    if ($defaultClientPropertyId !== false) {
        return ClientProperty::withoutGlobalScope('client-group')->find($defaultClientPropertyId);
    }
    $user = user();

    return $user ? ($user->client_property_id ? $user->clientProperty : lockedClientProperty()) : null;
}

function client() {
    $defaultClientId = Config::get('client.id');
    if ($defaultClientId !== false) {
        return Client::withoutGlobalScopes(['client-group', 'client-property'])->find($defaultClientId);
    }
    $user = user();

    return $user ? ($user->client_id ? $user->client : lockedClient()) : null;
}

function clientGroupId() {
    $clientGroup = clientGroup();

    return $clientGroup ? $clientGroup->id : null;
}

function clientPropertyId() {
    $clientProperty = clientProperty();

    return $clientProperty ? $clientProperty->id : null;
}

function clientId() {
    $client = client();

    return $client ? $client->id : null;
}

function recordExistsForClient($table) {
    return 'exists:' . $table . ',id,client_id,' . clientId() . ',deleted_at,NULL';
}

function lookupExists($table) {
    return 'exists:' . $table . ',id,client_group_id,' . clientGroupId() . ',deleted_at,NULL';
}

function clientPropertyList() {
    return ClientProperty::all()->pluck('name', 'id')->toArray();
}

function clientList($propertyId = null) {
    if ($propertyId) {
        return Client::withoutGlobalScope('client-property')->where('client_property_id', $propertyId)->pluck('name', 'id')->toArray();
    } else {
        return Client::withoutGlobalScope('client-property')->pluck('name', 'id')->toArray();
    }
}

function defaultClientProperty() {
    return ClientProperty::first();
}

function defaultClient($propertyId = null) {
    return Client::withoutGlobalScope('client-property')->where('client_property_id', $propertyId ?: defaultClientProperty()->id)->first();
}

function getSql($model) {
    $replace = function ($sql, $bindings) {
        $needle = '?';
        foreach ($bindings as $replace) {
            $pos = strpos($sql, $needle);
            if ($pos !== false) {
                if (gettype($replace) === "string") {
                    $replace = ' "' . addslashes($replace) . '" ';
                }
                $sql = substr_replace($sql, $replace, $pos, strlen($needle));
            }
        }
        return $sql;
    };
    $sql = $replace($model->toSql(), $model->getBindings());

    return $sql;
}

/**
 * Make a Key Name.
 *
 * @param  string  $module
 * @return string
 */
function getKeyName($module) {
    return str_replace(' ', '', ucwords(str_replace('-', ' ', $module)));
}

/**
 * Make a Model Name.
 *
 * @param  string  $module
 * @return string
 */
function getModelName($module) {
    return 'App\Http\Models\\' . getKeyName($module);
}

/**
 * Make a Resource Name.
 *
 * @param  string  $module
 * @return string
 */
function getResourceName($module) {
    return 'App\Http\Resources\\' . getKeyName($module);
}

/**
 * Make a Controller Name.
 *
 * @param  string  $module
 * @return string
 */
function getControllerName($module) {
    return 'App\Http\Controllers\API\v1\\' . getKeyName($module) . 'Controller';
}

function to_bool($val = null) {
    if ($val == "on" || $val != null) {
        return 1;
    } else {
        return 0;
    }
}
