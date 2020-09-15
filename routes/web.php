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
    Route::get('/add_code','App\Http\Controllers\Admin\CodeController@show_add_code');
    Route::get('/edit_code/{id}','App\Http\Controllers\Admin\CodeController@show_edit_code');
    Route::post('/save_code','App\Http\Controllers\Admin\CodeController@store');
    Route::post('/edit_code/update/{id}','App\Http\Controllers\Admin\CodeController@update');
    Route::get('code/remove/{id}','App\Http\Controllers\Admin\CodeController@destroy');

});


Route::group(['prefix' => 'helper'], function () {
    // Helper For Admin
    Route::get('categories/index','App\Http\Controllers\Admin\ApiHelperController@categoriesIndex');
    Route::get('sub_categories/with_category_id/{id}','App\Http\Controllers\Admin\ApiHelperController@subCategoryIndexWithCategoryId');

});
