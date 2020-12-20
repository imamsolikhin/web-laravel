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

Route::prefix('master')->namespace('Master')->as('master.')->group(function() {
    Route::resource('city', 'CityController', ['except' => ['create', 'show']]);

    Route::prefix('advertise')->as('advertise.')->group(function() {
        Route::post('data', 'AdvertiseController@getData')->name('data');
        Route::get('data', 'AdvertiseController@getData')->name('data');
        Route::get('{id}', 'AdvertiseController@show')->name('show');
    });
    Route::resource('advertise', 'AdvertiseController', ['except' => ['create', 'show']]);

    Route::prefix('bank')->as('bank.')->group(function() {
        Route::post('data', 'BankController@getData')->name('data');
        Route::get('data', 'BankController@getData')->name('data');
        Route::get('{id}', 'BankController@show')->name('show');
    });
    Route::resource('bank', 'BankController', ['except' => ['create', 'show']]);

    Route::prefix('branch')->as('branch.')->group(function() {
        Route::post('data', 'BranchController@getData')->name('data');
        Route::get('data', 'BranchController@getData')->name('data');
        Route::get('{id}', 'BranchController@show')->name('show');
    });
    Route::resource('branch', 'BranchController', ['except' => ['create', 'show']]);

    Route::prefix('city')->as('city.')->group(function() {
        Route::post('data', 'CityController@getData')->name('data');
        Route::get('data', 'CityController@getData')->name('data');
        Route::get('{id}', 'CityController@show')->name('show');
    });

    Route::prefix('clinci')->as('clinci.')->group(function() {
        Route::post('data', 'ClinicController@getData')->name('data');
        Route::get('data', 'ClinicController@getData')->name('data');
        Route::get('{id}', 'ClinicController@show')->name('show');
    });
    Route::resource('clinci', 'ClinicController', ['except' => ['create', 'show']]);

    Route::prefix('company')->as('company.')->group(function() {
        Route::post('data', 'CompanyController@getData')->name('data');
        Route::get('data', 'CompanyController@getData')->name('data');
        Route::get('{id}', 'CompanyController@show')->name('show');
    });
    Route::resource('company', 'CompanyController', ['except' => ['create', 'show']]);

    Route::prefix('confirmation')->as('confirmation.')->group(function() {
        Route::post('data', 'CompanyController@getData')->name('data');
        Route::get('data', 'CompanyController@getData')->name('data');
        Route::get('{id}', 'CompanyController@show')->name('show');
    });
    Route::resource('confirmation', 'CompanyController', ['except' => ['create', 'show']]);

    Route::prefix('courier')->as('courier.')->group(function() {
        Route::post('data', 'CourierController@getData')->name('data');
        Route::get('data', 'CourierController@getData')->name('data');
        Route::get('{id}', 'CourierController@show')->name('show');
    });
    Route::resource('courier', 'CourierController', ['except' => ['create', 'show']]);

    Route::prefix('gender')->as('gender.')->group(function() {
        Route::post('data', 'GenderController@getData')->name('data');
        Route::get('data', 'GenderController@getData')->name('data');
        Route::get('{id}', 'GenderController@show')->name('show');
    });
    Route::resource('gender', 'GenderController', ['except' => ['create', 'show']]);

    Route::prefix('interaction')->as('interaction.')->group(function() {
        Route::post('data', 'InteractionController@getData')->name('data');
        Route::get('data', 'InteractionController@getData')->name('data');
        Route::get('{id}', 'InteractionController@show')->name('show');
    });
    Route::resource('interaction', 'InteractionController', ['except' => ['create', 'show']]);

    Route::prefix('itemprice')->as('itemprice.')->group(function() {
        Route::post('data', 'ItemPriceController@getData')->name('data');
        Route::get('data', 'ItemPriceController@getData')->name('data');
        Route::get('{id}', 'ItemPriceController@show')->name('show');
    });
    Route::resource('itemprice', 'ItemPriceController', ['except' => ['create', 'show']]);

    Route::prefix('market')->as('market.')->group(function() {
        Route::post('data', 'MarketController@getData')->name('data');
        Route::get('data', 'MarketController@getData')->name('data');
        Route::get('{id}', 'MarketController@show')->name('show');
    });
    Route::resource('market', 'MarketController', ['except' => ['create', 'show']]);

    Route::prefix('paymenttype')->as('paymenttype.')->group(function() {
        Route::post('data', 'PaymentTypeController@getData')->name('data');
        Route::get('data', 'PaymentTypeController@getData')->name('data');
        Route::get('{id}', 'PaymentTypeController@show')->name('show');
    });
    Route::resource('paymenttype', 'PaymentTypeController', ['except' => ['create', 'show']]);

    Route::prefix('periode')->as('periode.')->group(function() {
        Route::post('data', 'PeriodeController@getData')->name('data');
        Route::get('data', 'PeriodeController@getData')->name('data');
        Route::get('{id}', 'PeriodeController@show')->name('show');
    });
    Route::resource('periode', 'PeriodeController', ['except' => ['create', 'show']]);

    Route::prefix('product')->as('product.')->group(function() {
        Route::post('data', 'ProductController@getData')->name('data');
        Route::get('data', 'ProductController@getData')->name('data');
        Route::get('{id}', 'ProductController@show')->name('show');
    });
    Route::resource('product', 'ProductController', ['except' => ['create', 'show']]);

    Route::prefix('shiftwork')->as('shiftwork.')->group(function() {
        Route::post('data', 'ShiftWorkController@getData')->name('data');
        Route::get('data', 'ShiftWorkController@getData')->name('data');
        Route::get('{id}', 'ShiftWorkController@show')->name('show');
    });
    Route::resource('shiftwork', 'ShiftWorkController', ['except' => ['create', 'show']]);
});

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
 //
 // $router->group(['prefix' => 'master', 'namespace' => 'Master', 'middleware' => 'web'], function () use ($router) {
 //     $router->group(['prefix' => '{table}'], function () use ($router) {
 //         $router->get('/', [
 //             'as' => 'master.index', 'uses' => 'MasterController@index'
 //         ]);
 //         $router->post('list', [
 //             'as' => 'master.list', 'uses' => 'MasterController@list'
 //         ]);
 //         $router->get('list', [
 //             'as' => 'master.list', 'uses' => 'MasterController@list'
 //         ]);
 //         $router->get('data/{id}', [
 //             'as' => 'master.data', 'uses' => 'MasterController@data'
 //         ]);
 //         $router->post('save', [
 //             'as' => 'master.save', 'uses' => 'MasterController@save'
 //         ]);
 //         $router->post('update/{id}', [
 //             'as' => 'master.update', 'uses' => 'MasterController@update'
 //         ]);
 //         $router->delete('{id}', [
 //             'as' => 'master.delete', 'uses' => 'MasterController@delete'
 //         ]);
 //     });
 // });

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
