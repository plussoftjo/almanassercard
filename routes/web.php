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

Route::get('/', function () {
    return view('welcome');
});



Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    // Code 
    Route::get('/code','App\Http\Controllers\Admin\CodeController@show_code');
    Route::get('/code_trash','App\Http\Controllers\Admin\CodeController@CodeTrash');
    Route::get('/add_code','App\Http\Controllers\Admin\CodeController@show_add_code');
    Route::get('/edit_code/{id}','App\Http\Controllers\Admin\CodeController@show_edit_code');
    Route::post('/save_code','App\Http\Controllers\Admin\CodeController@store');
    Route::post('/edit_code/update/{id}','App\Http\Controllers\Admin\CodeController@update');
    Route::get('code/remove/{id}','App\Http\Controllers\Admin\CodeController@destroy');
    Route::get('dashboard', 'App\Http\Controllers\Admin\AdminController@dashboard');
    Route::get('/add_balance','App\Http\Controllers\Admin\AdminController@add_balance_view');
    Route::post('/add_balance/store','App\Http\Controllers\Admin\AdminController@add_balance');


    /** Reports */
    Route::get('/reports','App\Http\Controllers\Admin\ReportController@index');
    Route::get('/reports/fetch/{type}','App\Http\Controllers\Admin\ReportController@fetch');

    

    /** FetchCount */
    Route::get('/fetch_count','App\Http\Controllers\Admin\FetchCountController@index');
    Route::post('/fetch_count/fetch','App\Http\Controllers\Admin\FetchCountController@fetch');

    // Change code
    Route::get('/code/change_state/{id}','App\Http\Controllers\Admin\CodeController@updateActive');

    Route::get('/code/change_state/{id}','App\Http\Controllers\Admin\CodeController@updateActive');


    // Code Checker 
    Route::get('code_checker','App\Http\Controllers\Admin\CodeController@CodeChecker');
    Route::post('check/code','App\Http\Controllers\Admin\CodeController@CheckCode');


    // Clients
    Route::get('clients/index','App\Http\Controllers\Admin\ClientController@index');
    Route::get('clients/show/{id}','App\Http\Controllers\Admin\ClientController@show');
});


Route::group(['prefix' => 'helper'], function () {
    // Helper For Admin
    Route::get('categories/index','App\Http\Controllers\Admin\ApiHelperController@categoriesIndex');
    Route::get('sub_categories/with_category_id/{id}','App\Http\Controllers\Admin\ApiHelperController@subCategoryIndexWithCategoryId');
    Route::get('last_categories/with_category_id/{id}', 'App\Http\Controllers\Admin\ApiHelperController@lastCategoryIndexWithSubCategory');


    // Admin Controller
});
