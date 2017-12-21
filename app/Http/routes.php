<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group([ 'prefix' => 'admin', 'namespace' => 'Admin'], function ()
{
    Route::any('login', 'LoginController@login')->name('viewLogin');
    Route::any('register', 'LoginController@register')->name('viewRegister');
    Route::get('verifyCode', 'CommonController@verifyCode')->name('viewVerifyCode');
});

Route::group(['middleware' => ['admin.login'], 'prefix' => 'admin', 'namespace' => 'Admin'], function ()
{
    Route::get('index', 'IndexController@index')->name('viewIndex');
    Route::get('info', 'IndexController@info')->name('viewInfo');
});


