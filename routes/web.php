<?php

use Illuminate\Support\Facades\Auth;
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


Auth::routes();
Route::get('/dashboard', "App\Http\Controllers\Admin\AdminCourseController@index");
Route::get('/dashboard/{any}', "App\Http\Controllers\Admin\AdminCourseController@index")->where("any", ".*");
Route::get('/dashboard/{any}/{page}', "App\Http\Controllers\Admin\AdminCourseController@index")->where("any", ".*")->where("page", ".*");
Route::post('/contact-us', "App\Http\Controllers\IndexController@contactUs");
Route::get('{page}', "App\Http\Controllers\IndexController@index")->where("page", ".*");
