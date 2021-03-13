<?php

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
        'status_id' => $statusCode,
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

function currDate() {
  date_default_timezone_set ('Asia/Jakarta');
  return date("Y-m-d H:i", time());
}

function sess_company($prm = null) {
  if($prm){
    return Session::get('com')[$prm];
  }
  return null;
}
function sess_user($prm = null) {
  if($prm){
    return Session::get('user')[$prm];
  }
  return null;
}

function sess_shift($prm = null) {
  if($prm){
    if(Session::get('shift')){
      return Session::get('shift')[$prm];
    }
    return 0;
  }
  return null;
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
function getModelName($folder, $module) {
    return 'App\Http\Models\\' . $folder .'\\' . getKeyName($module);
}

/**
 * Make a Resource Name.
 *
 * @param  string  $module
 * @return string
 */
function getResourceName($folder, $module) {
    return 'App\Http\Resources\\' . $folder .'\\' . getKeyName($module);
}

/**
 * Make a Controller Name.
 *
 * @param  string  $module
 * @return string
 */
function getControllerName($folder,$module) {
    return 'App\Http\Controllers\\'. $folder .'\\' . getKeyName($module) . 'Controller';
}

function generadeCode($folder, $table, $branch=Null, $prfix=Null, $numb=5)
{
   $branch = ($branch)? $branch."-":"";
   $prfix = ($prfix)? $branch.$prfix."-":$branch;
   $last_count = getResourceName($folder,$table)::where('company_id',sess_company('id'))->count();
   $code = $prfix.str_pad(($last_count+1), $numb, '0', STR_PAD_LEFT);
   return $code;
}

function to_bool($val = null) {
    if ($val == "on" || $val != null) {
        return 1;
    } else {
        return 0;
    }
}

  function getAuthMenu($module,$key) {
    $flag = App\Models\RoleAuth::select("role_menu_auth.".$key." AS key")
                  ->join('menus', 'menus.id', '=', 'role_menu_auth.menu_id')
                  ->where('role_menu_auth.role_id',sess_user('role_id'))
                  ->where('menus.url',\URL::route($module,[],false))
                  ->first();
    if($flag){
      return $flag->key;
    }
    return False;
  }

  function getAttrLogin() {
      $data[] = 'clinic';
      $data[] = 'marketing-clinic';
      $data[] = 'marketing-product';

      foreach ($data as $val) {
        if($val == APP_BRANCH){
          return true;
        }
      }
     return false;
  }
