<?php
//
// Route::group(['prefix' => 'master', 'namespace' => 'Master'], function () use ($router) {
//     Route::group(['prefix' => '{table}'], function () use ($router) {
//         Route::get('/', [
//             'as' => 'master.index', 'uses' => 'MasterController@index'
//         ]);
//         Route::post('data', [
//             'as' => 'master.data', 'uses' => 'MasterController@datatableAjax'
//         ]);
//         Route::get('{id}', [
//             'as' => 'master.show', 'uses' => 'MasterController@show'
//         ]);
//         Route::post('/save', [
//             'as' => 'master.store', 'uses' => 'MasterController@store'
//         ]);
//         Route::post('/update/{id}', [
//             'as' => 'master.update', 'uses' => 'MasterController@update'
//         ]);
//         Route::get('/delete/{id}', [
//             'as' => 'master.destroy', 'uses' => 'MasterController@destroy'
//         ]);
//         Route::resource('master', 'MasterController', ['except' => ['create', 'show']]);
//     });
// });
//

Route::resource('advertise', 'AdvertiseController', ['except' => ['create']]);
Route::post('advertise/data', 'AdvertiseController@getData')->name('advertise.data');

Route::resource('bank', 'BankController', ['except' => ['create']]);
Route::post('bank/data', 'BankController@getData')->name('bank.data');

Route::resource('branch', 'BranchController', ['except' => ['create']]);
Route::post('branch/data', 'BranchController@getData')->name('branch.data');

Route::resource('clinic', 'ClinicController', ['except' => ['create']]);
Route::post('clinic/data', 'ClinicController@getData')->name('clinic.data');

Route::resource('company', 'CompanyController', ['except' => ['create']]);
Route::post('company/data', 'CompanyController@getData')->name('company.data');

Route::resource('city', 'CityController', ['except' => ['create']]);
Route::post('city/data', 'CityController@getData')->name('city.data');

Route::resource('confirmation', 'ConfirmationController', ['except' => ['create']]);
Route::post('confirmation/data', 'ConfirmationController@getData')->name('confirmation.data');

Route::resource('courier', 'CourierController', ['except' => ['create']]);
Route::post('courier/data', 'CourierController@getData')->name('courier.data');

Route::resource('gender', 'GenderController', ['except' => ['create']]);
Route::post('gender/data', 'GenderController@getData')->name('gender.data');

Route::resource('interaction', 'InteractionController', ['except' => ['create']]);
Route::post('interaction/data', 'InteractionController@getData')->name('interaction.data');

Route::resource('itemprice', 'ItemPriceController', ['except' => ['create']]);
Route::post('itemprice/data', 'ItemPriceController@getData')->name('itemprice.data');

Route::resource('market', 'MarketController', ['except' => ['create']]);
Route::post('market/data', 'MarketController@getData')->name('market.data');

Route::resource('paymenttype', 'PaymentTypeController', ['except' => ['create']]);
Route::post('paymenttype/data', 'PaymentTypeController@getData')->name('paymenttype.data');

Route::resource('periode', 'PeriodeController', ['except' => ['create']]);
Route::post('periode/data', 'PeriodeController@getData')->name('periode.data');

Route::resource('product', 'ProductController', ['except' => ['create']]);
Route::post('product/data', 'ProductController@getData')->name('product.data');

Route::resource('shipwork', 'shipworkController', ['except' => ['create']]);
Route::post('shipwork/data', 'shipworkController@getData')->name('shipwork.data');
