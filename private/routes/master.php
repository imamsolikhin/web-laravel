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

Route::middleware('web')->group(function() {
   Route::middleware('guest')->namespace('Auth')->group(function() {
    Route::get('/', 'LoginController@showLoginForm')->name('login.main');
   	Route::get('login', 'LoginController@showLoginForm')->name('login.show-form');
   	Route::post('login', 'LoginController@login')->name('login');
   });
  Route::get('logout', 'Auth\LoginController@logout')->name('logout');
});

Route::prefix('management')->namespace('Management')->as('management.')->group(function() {
    Route::prefix('user')->as('user.')->group(function() {
        Route::post('data', 'UserController@getData')->name('data');
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
    });
    Route::resource('role', 'RoleController', ['except' => ['create', 'show']]);
});

// Route::prefix('master')->namespace('Master')->as('master.')->group(function() {
//     Route::prefix('{table}')->group(function() {
//         Route::get('/', 'MasterController@index')->name('index');
//         Route::post('/', 'MasterController@update')->name('save');
//         Route::post('update/{id}', 'MasterController@update')->name('update');
//         Route::post('data', 'MasterController@getData')->name('data');
//         Route::delete('{id}', 'MasterController@delete')->name('delete');
//     });
// });

 $router->group(['prefix' => 'clinic', 'namespace' => 'Clinic'], function () use ($router) {
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
