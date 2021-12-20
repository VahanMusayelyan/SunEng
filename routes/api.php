<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'App\Http\Controllers\User', 'prefix' => 'users'], function () {
    Route::post("/", 'StoreController@index');
});

Route::post('/checkUsername', 'App\Http\Controllers\UserController@checkUsername');
Route::post('/checkPhone', 'App\Http\Controllers\UserController@checkPhone');
Route::post('/translation', 'App\Http\Controllers\TranslationController@translation');


Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {

    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me');


    Route::group(['middleware' => 'jwt.auth','prefix' => ''], function ($router) {
            Route::post("/fruits", 'App\Http\Controllers\Fruit\FruitController@index');
    });



});

Route::group(['middleware' => 'isAdmin','prefix' => 'dashboard'], function ($router) {
    Route::get("/", 'App\Http\Controllers\Admin\AdminController@index');
    Route::post("/courses", 'App\Http\Controllers\Admin\AdminController@courses');
    Route::post("/parent-courses", 'App\Http\Controllers\Admin\AdminController@parent_courses');
    Route::post("/add-course", 'App\Http\Controllers\Admin\AdminController@add_course');
    Route::post("/edit-course", 'App\Http\Controllers\Admin\AdminController@edit_course');
    Route::post("/update-course", 'App\Http\Controllers\Admin\AdminController@update_course');
    Route::post("/delete-course", 'App\Http\Controllers\Admin\AdminController@delete_course');
    Route::post("/add-main-course", 'App\Http\Controllers\Admin\AdminController@add_main_course');
    Route::post("/edit-main-course", 'App\Http\Controllers\Admin\AdminController@edit_main_course');
    Route::post("/update-main-course", 'App\Http\Controllers\Admin\AdminController@update_main_course');
});
