<?php

Route::middleware('web')->group(function() {
    Route::middleware('guest')->namespace('Auth')->group(function() {
    	Route::get('login', 'LoginController@showLoginForm')->name('login.show-form');
    	Route::post('login', 'LoginController@login')->name('login');
    });
   Route::get('logout', 'Auth\LoginController@logout')->name('logout');
});