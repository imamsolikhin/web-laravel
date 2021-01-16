<?php

use Illuminate\Support\Facades\Route;

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

 /*
  * These routes require no users to be logged in
  */

Route::get('/', 'HomeController@index');
Route::get('dashboard', 'HomeController@dashboard')->name('dashboard');
Route::get('/quick-search', 'PagesController@quickSearch')->name('quick-search');
Route::get('/noauth', 'HomeController@noauth')->name('noauth');

Route::middleware('web')->group(function() {
   Route::middleware('guest')->namespace('Auth')->group(function() {
    Route::get('/', 'LoginController@showLoginForm')->name('login.main');
    Route::get('/attribute', 'LoginController@attribute')->name('login.attribute');
   	Route::get('login', 'LoginController@showLoginForm')->name('login.show-form');
   	Route::post('login', 'LoginController@login')->name('login');
   });
  Route::get('logout', 'Auth\LoginController@logout')->name('logout');
});

Route::middleware('web')->group(function() {
  Route::prefix('management')->namespace('Management')->as('management.')->group(function() {
      Route::prefix('user')->as('user.')->group(function() {
          Route::post('data', 'UserController@getData')->name('data');
          Route::delete('{id}', 'UserController@destroy')->name('show');
          Route::get('{id}', 'UserController@edit')->name('show');
          Route::get('{id}/change-password', 'UserController@changeOtherPassword')->name('other.change-password');
          Route::put('{id}/update-password', 'UserController@updateOtherPassword')->name('other.update-password');
      });
      Route::resource('user', 'UserController', ['except' => ['create', 'show']]);

     Route::get('login-history', 'UserHistoryController@showLoginHistory')->name('login-history');
     Route::post('login-history/data', 'UserHistoryController@getLoginHistoryData')->name('login-history.data');

     Route::prefix('role')->as('role.')->group(function() {
         Route::post('data', 'RoleController@getData')->name('data');
         Route::get('{id}', 'RoleController@show')->name('show');
         Route::get('auth/{id}', 'RoleController@show_auth')->name('show.auth');
         Route::post('{id}/{col}/{val}', 'RoleController@update_auth')->name('update.auth');
     });
     Route::resource('role', 'RoleController', ['except' => ['create', 'show']]);

     Route::prefix('menu')->as('menu.')->group(function() {
         Route::post('data', 'MenuController@getData')->name('data');
         Route::get('{id}', 'MenuController@show')->name('show');
     });
     Route::resource('menu', 'MenuController', ['except' => ['create', 'show']]);
  });
});


$router->group(['prefix' => 'master', 'namespace' => 'Master', 'middleware' => 'auth'], function () use ($router) {
    $router->group(['prefix' => '{table}'], function () use ($router) {
        $router->get('/', [
            'as' => 'master.index', 'uses' => 'MasterController@index'
        ]);
        $router->post('list', [
            'as' => 'master.list', 'uses' => 'MasterController@list'
        ]);
        $router->get('list', [
            'as' => 'master.list', 'uses' => 'MasterController@list'
        ]);
        $router->get('data/{id}', [
            'as' => 'master.data', 'uses' => 'MasterController@data'
        ]);
        $router->post('/', [
            'as' => 'master.save', 'uses' => 'MasterController@save'
        ]);
        $router->put('/{id}', [
            'as' => 'master.update', 'uses' => 'MasterController@update'
        ]);
        $router->delete('{id}', [
            'as' => 'master.delete', 'uses' => 'MasterController@delete'
        ]);
    });
});

 $router->group(['prefix' => 'clinic', 'namespace' => 'Clinic', 'middleware' => 'auth'], function () use ($router) {
     $router->group(['prefix' => '{table}'], function () use ($router) {
         $router->get('/', [
             'as' => 'clinic.index', 'uses' => 'ClinicController@index'
         ]);
         $router->post('list', [
             'as' => 'clinic.list', 'uses' => 'ClinicController@list'
         ]);
         $router->get('list', [
             'as' => 'clinic.list', 'uses' => 'ClinicController@list'
         ]);
         $router->get('data/{id}', [
             'as' => 'clinic.data', 'uses' => 'ClinicController@data'
         ]);
         $router->post('save', [
             'as' => 'clinic.save', 'uses' => 'ClinicController@save'
         ]);
         $router->post('update/{id}', [
             'as' => 'clinic.update', 'uses' => 'ClinicController@update'
         ]);
         $router->delete('{id}', [
             'as' => 'clinic.delete', 'uses' => 'ClinicController@delete'
         ]);
     });
 });

 $router->group(['prefix' => 'product', 'namespace' => 'Product'], function () use ($router) {
     $router->group(['prefix' => '{table}'], function () use ($router) {
         $router->get('/', [
             'as' => 'product.index', 'uses' => 'ProductController@index'
         ]);
         $router->post('list', [
             'as' => 'product.list', 'uses' => 'ProductController@list'
         ]);
         $router->get('list', [
             'as' => 'product.list', 'uses' => 'ProductController@list'
         ]);
         $router->get('data/{id}', [
             'as' => 'product.data', 'uses' => 'ProductController@data'
         ]);
         $router->post('save', [
             'as' => 'product.save', 'uses' => 'ProductController@save'
         ]);
         $router->post('update/{id}', [
             'as' => 'product.update', 'uses' => 'ProductController@update'
         ]);
         $router->delete('{id}', [
             'as' => 'product.delete', 'uses' => 'ProductController@delete'
         ]);
     });
 });

 $router->group(['prefix' => 'warehouse', 'namespace' => 'Warehouse'], function () use ($router) {
     $router->group(['prefix' => '{table}'], function () use ($router) {
         $router->get('/', [
             'as' => 'warehouse.index', 'uses' => 'WarehouseController@index'
         ]);
         $router->post('list', [
             'as' => 'warehouse.list', 'uses' => 'WarehouseController@list'
         ]);
         $router->get('list', [
             'as' => 'warehouse.list', 'uses' => 'WarehouseController@list'
         ]);
         $router->get('data/{id}', [
             'as' => 'warehouse.data', 'uses' => 'WarehouseController@data'
         ]);
         $router->post('save', [
             'as' => 'warehouse.save', 'uses' => 'WarehouseController@save'
         ]);
         $router->post('update/{id}', [
             'as' => 'warehouse.update', 'uses' => 'WarehouseController@update'
         ]);
         $router->delete('{id}', [
             'as' => 'product.delete', 'uses' => 'ProductController@delete'
         ]);
     });
 });

Auth::routes();
