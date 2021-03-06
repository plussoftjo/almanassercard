<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('main/index','App\Http\Controllers\Api\MainController@index');


/** Auth Controller  */
Route::post('auth/register','App\Http\Controllers\Api\AuthController@register');
Route::post('auth/login','App\Http\Controllers\Api\AuthController@login');
Route::post('auth/update','App\Http\Controllers\Api\AuthController@login');
Route::get('auth/get/{id}','App\Http\Controllers\Api\AuthController@get_user');
Route::post('auth/update_password','App\Http\Controllers\Api\AuthController@update_password');


/** Order Controller  */
Route::post('order/store','App\Http\Controllers\Api\OrderController@NewStoreOrder');
Route::get('order/index/{user_id}','App\Http\Controllers\Api\OrderController@index');

// Categories
Route::post('search/index','App\Http\Controllers\Api\MainController@search');


//// USER API AUTH

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('auth/auth','App\Http\Controllers\Api\AuthController@auth');
});


/** Report Controller */
Route::post('report/fetch','App\Http\Controllers\Api\ReportController@fetch');
Route::post('report/searchWithDate','App\Http\Controllers\Api\ReportController@searchWithDate');

Route::get('checkserver','App\Http\Controllers\Api\MainController@checkServer');