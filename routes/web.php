<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpaController;
use App\Http\Controllers\TestController;

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

Route::post('/app/create_tag', 'TestController@test');

Route::get('/{any}', 'SpaController@index')->where('any', '.*');


