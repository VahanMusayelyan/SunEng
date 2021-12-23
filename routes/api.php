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
    Route::get("/", 'App\Http\Controllers\Admin\AdminCourseController@index');
    Route::post("/courses", 'App\Http\Controllers\Admin\AdminCourseController@courses');
    Route::post("/parent-courses", 'App\Http\Controllers\Admin\AdminCourseController@parent_courses');

    Route::post("/add-course", 'App\Http\Controllers\Admin\AdminCourseController@addCourse');
    Route::post("/edit-course", 'App\Http\Controllers\Admin\AdminCourseController@editCourse');
    Route::post("/update-course", 'App\Http\Controllers\Admin\AdminCourseController@updateCourse');
    Route::post("/delete-course", 'App\Http\Controllers\Admin\AdminCourseController@deleteCourse');

    Route::post("/add-main-course", 'App\Http\Controllers\Admin\AdminCourseController@addMainCourse');
    Route::post("/edit-main-course", 'App\Http\Controllers\Admin\AdminCourseController@editMainCourse');
    Route::post("/update-main-course", 'App\Http\Controllers\Admin\AdminCourseController@updateMainCourse');
    Route::post("/delete-main-course", 'App\Http\Controllers\Admin\AdminCourseController@deleteMainCourse');

    Route::post("/course-lessons", 'App\Http\Controllers\Admin\AdminLessonController@index');
    Route::post("/lessons-list", 'App\Http\Controllers\Admin\AdminLessonController@lessonsList');
    Route::post("/add-lesson", 'App\Http\Controllers\Admin\AdminLessonController@addLesson');
    Route::post("/edit-lesson", 'App\Http\Controllers\Admin\AdminLessonController@editLesson');
    Route::post("/update-lesson", 'App\Http\Controllers\Admin\AdminLessonController@updateLesson');
    Route::post("/delete-lesson", 'App\Http\Controllers\Admin\AdminLessonController@deleteLesson');
    Route::post("/lesson-show", 'App\Http\Controllers\Admin\AdminLessonController@lessonShow');
    Route::post("/lesson-title", 'App\Http\Controllers\Admin\AdminLessonController@lessonTitle');
    Route::post("/add-slide", 'App\Http\Controllers\Admin\AdminLessonController@addSlide');
    Route::post("/slides-list", 'App\Http\Controllers\Admin\AdminLessonController@getSlides');
    Route::post("/add-homework", 'App\Http\Controllers\Admin\AdminLessonController@addHomework');
    Route::post("/homeworks-list", 'App\Http\Controllers\Admin\AdminLessonController@getHomeworks');
    Route::post("/add-lesson-slide", 'App\Http\Controllers\Admin\AdminLessonController@addLessonSlide');
    Route::post("/add-lesson-homework", 'App\Http\Controllers\Admin\AdminLessonController@addLessonHomework');
    Route::post("/slides-and-homeworks", 'App\Http\Controllers\Admin\AdminLessonController@listSlidesHomeworks');
    Route::post("/delete-lesson-homework", 'App\Http\Controllers\Admin\AdminLessonController@deleteLessonWork');
    Route::post("/delete-lesson-slide", 'App\Http\Controllers\Admin\AdminLessonController@deleteLessonSlide');

});
