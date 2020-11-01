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

Route::get('/', 'PagesController@index');

Route::get('/', 'HomeController@index');
Route::get('dashboard', 'HomeController@dashboard')->name('dashboard');

// Demo routes
// Route::get('/datatables', 'PagesController@datatables')->name('datatables');
// Route::get('/ktdatatables', 'PagesController@ktDatatables');
// Route::get('/select2', 'PagesController@select2');
// Route::get('/icons/custom-icons', 'PagesController@customIcons');
// Route::get('/icons/flaticon', 'PagesController@flaticon');
// Route::get('/icons/fontawesome', 'PagesController@fontawesome');
// Route::get('/icons/lineawesome', 'PagesController@lineawesome');
// Route::get('/icons/socicons', 'PagesController@socicons');
// Route::get('/icons/svg', 'PagesController@svg');
// Quick search dummy route to display html elements in search dropdown (header search)
Route::get('/quick-search', 'PagesController@quickSearch')->name('quick-search');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('product')->namespace('Product')->as('product.')->group(function() {
    Route::prefix('interaksi')->as('interaksi.')->group(function() {
        Route::post('data', 'InteraksiController@getData')->name('data');
        Route::get('/{id}', 'InteraksiController@show')->name('show');
    });
    Route::resource('interaksi', 'InteraksiController', ['except' => ['create', 'show']]);

    Route::prefix('lead')->as('lead.')->group(function() {
        Route::post('data', 'LeadController@getData')->name('data');
        Route::get('/{id}', 'LeadController@show')->name('show');
    });
    Route::resource('lead', 'LeadController', ['except' => ['create', 'show']]);

    Route::prefix('followup')->as('followup.')->group(function() {
        Route::post('data', 'FollowupController@getData')->name('data');
        Route::get('/{id}', 'FollowupController@show')->name('show');
    });
    Route::resource('followup', 'FollowupController', ['except' => ['create', 'show']]);

    Route::prefix('transaksi')->as('transaksi.')->group(function() {
        Route::post('data', 'TransaksiController@getData')->name('data');
        Route::get('/{id}', 'TransaksiController@show')->name('show');
    });
    Route::resource('transaksi', 'TransaksiController', ['except' => ['create', 'show']]);

    Route::prefix('closing')->as('closing.')->group(function() {
        Route::post('data', 'ClosingController@getData')->name('data');
        Route::get('/{id}', 'ClosingController@show')->name('show');
    });
    Route::resource('closing', 'ClosingController', ['except' => ['create', 'show']]);
});

Route::prefix('product-admin')->namespace('ProductAdmin')->as('product-admin.')->group(function() {

    Route::prefix('bank-received')->as('bank-received.')->group(function() {
        Route::post('data', 'BankReceivedController@getData')->name('data');
        Route::get('/{id}', 'BankReceivedController@show')->name('show');
    });
    Route::resource('bank-received', 'BankReceivedController', ['except' => ['create', 'show']]);

    Route::prefix('bank-payment')->as('bank-payment.')->group(function() {
        Route::post('data', 'BankPaymentController@getData')->name('data');
        Route::get('/{id}', 'BankPaymentController@show')->name('show');
    });
    Route::resource('bank-payment', 'BankPaymentController', ['except' => ['create', 'show']]);

    Route::prefix('omset')->as('omset.')->group(function() {
        Route::post('data', 'OmsetController@getData')->name('data');
        Route::get('/{id}', 'OmsetController@show')->name('show');
    });
    Route::resource('omset', 'OmsetController', ['except' => ['create', 'show']]);

    Route::prefix('kwitansi')->as('kwitansi.')->group(function() {
        Route::post('data', 'KwitansiController@getData')->name('data');
        Route::get('/{id}', 'KwitansiController@show')->name('show');
    });
    Route::resource('kwitansi', 'KwitansiController', ['except' => ['create', 'show']]);

    Route::prefix('closing-product')->as('closing-product.')->group(function() {
        Route::post('data', 'CLosingProductController@getData')->name('data');
        Route::get('/{id}', 'CLosingProductController@show')->name('show');
    });
    Route::resource('closing-product', 'CLosingProductController', ['except' => ['create', 'show']]);
});

Route::prefix('product-warehouse')->namespace('ProductWarehouse')->as('product-warehouse.')->group(function() {

    Route::prefix('stock-in')->as('stock-in.')->group(function() {
        Route::post('data', 'StockInController@getData')->name('data');
        Route::get('/{id}', 'StockInController@show')->name('show');
    });
    Route::resource('stock-in', 'StockInController', ['except' => ['create', 'show']]);

    Route::prefix('stock-out')->as('stock-out.')->group(function() {
        Route::post('data', 'StockOutController@getData')->name('data');
        Route::get('/{id}', 'StockOutController@show')->name('show');
    });
    Route::resource('stock-out', 'StockOutController', ['except' => ['create', 'show']]);

    Route::prefix('stock-opname')->as('stock-opname.')->group(function() {
        Route::post('data', 'StockOpnameController@getData')->name('data');
        Route::get('/{id}', 'StockOpnameController@show')->name('show');
    });
    Route::resource('stock-opname', 'StockOpnameController', ['except' => ['create', 'show']]);

    Route::prefix('stock-product')->as('stock-product.')->group(function() {
        Route::post('data', 'StockProductController@getData')->name('data');
        Route::get('/{id}', 'StockProductController@show')->name('show');
    });
    Route::resource('stock-product', 'StockProductController', ['except' => ['create', 'show']]);

    Route::prefix('delivery-order')->as('delivery-order.')->group(function() {
        Route::post('data', 'DeliveryOrderController@getData')->name('data');
        Route::get('/{id}', 'DeliveryOrderController@show')->name('show');
    });
    Route::resource('delivery-order', 'DeliveryOrderController', ['except' => ['create', 'show']]);

    Route::prefix('delivery-return')->as('delivery-return.')->group(function() {
        Route::post('data', 'DeliveryReturnController@getData')->name('data');
        Route::get('/{id}', 'DeliveryReturnController@show')->name('show');
    });
    Route::resource('delivery-return', 'DeliveryReturnController', ['except' => ['create', 'show']]);
});

Route::prefix('clinic')->namespace('Clinic')->as('clinic.')->group(function() {
    Route::prefix('interaksi')->as('interaksi.')->group(function() {
        Route::post('data', 'InteraksiController@getData')->name('data');
        Route::get('/{id}', 'InteraksiController@show')->name('show');
    });
    Route::resource('interaksi', 'InteraksiController', ['except' => ['create', 'show']]);

    Route::prefix('lead')->as('lead.')->group(function() {
        Route::post('data', 'LeadController@getData')->name('data');
        Route::get('/{id}', 'LeadController@show')->name('show');
    });
    Route::resource('lead', 'LeadController', ['except' => ['create', 'show']]);

    Route::prefix('followup')->as('followup.')->group(function() {
        Route::post('data', 'FollowupController@getData')->name('data');
        Route::get('/{id}', 'FollowupController@show')->name('show');
    });
    Route::resource('followup', 'FollowupController', ['except' => ['create', 'show']]);

    Route::prefix('reservation')->as('reservation.')->group(function() {
        Route::post('data', 'ReservationController@getData')->name('data');
        Route::get('/{id}', 'ReservationController@show')->name('show');
    });
    Route::resource('reservation', 'ReservationController', ['except' => ['create', 'show']]);

    Route::prefix('closing')->as('closing.')->group(function() {
        Route::post('data', 'ClosingController@getData')->name('data');
        Route::get('/{id}', 'ClosingController@show')->name('show');
    });
    Route::resource('closing', 'ClosingController', ['except' => ['create', 'show']]);
});

Route::prefix('clinic-admin')->namespace('ClinicAdmin')->as('clinic-admin.')->group(function() {

    Route::prefix('pasien')->as('pasien.')->group(function() {
        Route::post('data', 'PasienController@getData')->name('data');
        Route::get('/{id}', 'PasienController@show')->name('show');
    });
    Route::resource('pasien', 'PasienController', ['except' => ['create', 'show']]);

    Route::prefix('ramuan')->as('ramuan.')->group(function() {
        Route::post('data', 'RamuanController@getData')->name('data');
        Route::get('/{id}', 'RamuanController@show')->name('show');
    });
    Route::resource('ramuan', 'RamuanController', ['except' => ['create', 'show']]);

    Route::prefix('kwitansi')->as('kwitansi.')->group(function() {
        Route::post('data', 'KwitansiController@getData')->name('data');
        Route::get('/{id}', 'KwitansiController@show')->name('show');
    });
    Route::resource('kwitansi', 'KwitansiController', ['except' => ['create', 'show']]);

    Route::prefix('closing-clinic')->as('closing-clinic.')->group(function() {
        Route::post('data', 'CLosingClinicController@getData')->name('data');
        Route::get('/{id}', 'CLosingClinicController@show')->name('show');
    });
    Route::resource('closing-clinic', 'CLosingClinicController', ['except' => ['create', 'show']]);
});

Route::prefix('management')->namespace('Management')->as('management.')->group(function() {
    Route::prefix('user')->as('user.')->group(function() {
        Route::post('data', 'UserController@getData')->name('data');
        Route::get('{id}/change-password', 'UserController@changeOtherPassword')->name('other.change-password');
        Route::put('{id}/update-password', 'UserController@updateOtherPassword')->name('other.update-password');
    });
    Route::resource('user', 'UserController', ['except' => ['create', 'show']]);
    Route::get('login-history', 'UserController@showLoginHistory')->name('login-history');
    Route::post('login-history/data', 'UserController@getLoginHistoryData')->name('login-history.data');

    Route::resource('role', 'RoleController', ['except' => ['show']]);
    Route::post('role/data', 'RoleController@getData')->name('role.data');
});
