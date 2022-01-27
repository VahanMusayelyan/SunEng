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
    Route::get("/courses", 'App\Http\Controllers\Admin\AdminCourseController@courses');
    Route::get("/parent-courses", 'App\Http\Controllers\Admin\AdminCourseController@parent_courses');

    Route::post("/add-course", 'App\Http\Controllers\Admin\AdminCourseController@addCourse');
    Route::post("/edit-course", 'App\Http\Controllers\Admin\AdminCourseController@editCourse');
    Route::post("/update-course", 'App\Http\Controllers\Admin\AdminCourseController@updateCourse');
    Route::post("/delete-course", 'App\Http\Controllers\Admin\AdminCourseController@deleteCourse');

    Route::post("/add-main-course", 'App\Http\Controllers\Admin\AdminCourseController@addMainCourse');
    Route::post("/edit-main-course", 'App\Http\Controllers\Admin\AdminCourseController@editMainCourse');
    Route::post("/update-main-course", 'App\Http\Controllers\Admin\AdminCourseController@updateMainCourse');
    Route::post("/delete-main-course", 'App\Http\Controllers\Admin\AdminCourseController@deleteMainCourse');

    Route::post("/course-lessons", 'App\Http\Controllers\Admin\AdminLessonController@index');
    Route::get("/lessons-list", 'App\Http\Controllers\Admin\AdminLessonController@lessonsList');
    Route::post("/lessons-list-course", 'App\Http\Controllers\Admin\AdminLessonController@lessonsListCourse');
    Route::post("/add-lesson", 'App\Http\Controllers\Admin\AdminLessonController@addLesson');
    Route::post("/edit-lesson", 'App\Http\Controllers\Admin\AdminLessonController@editLesson');
    Route::post("/update-lesson", 'App\Http\Controllers\Admin\AdminLessonController@updateLesson');
    Route::post("/delete-lesson", 'App\Http\Controllers\Admin\AdminLessonController@deleteLesson');
    Route::post("/lesson-show", 'App\Http\Controllers\Admin\AdminLessonController@lessonShow');
    Route::post("/lesson-title", 'App\Http\Controllers\Admin\AdminLessonController@lessonTitle');


    Route::post("/add-lesson-slide", 'App\Http\Controllers\Admin\AdminLessonController@addLessonSlide');
    Route::post("/add-lesson-homework", 'App\Http\Controllers\Admin\AdminLessonController@addLessonHomework');
    Route::post("/slides-and-homeworks", 'App\Http\Controllers\Admin\AdminLessonController@listSlidesHomeworks');
    Route::post("/delete-lesson-homework", 'App\Http\Controllers\Admin\AdminLessonController@deleteLessonWork');
    Route::post("/delete-lesson-slide", 'App\Http\Controllers\Admin\AdminLessonController@deleteLessonSlide');

    Route::get("/homeworks", 'App\Http\Controllers\Admin\AdminSlideWorkController@getHomeworks');
    Route::post("/edit-homework", 'App\Http\Controllers\Admin\AdminSlideWorkController@editHomework');
    Route::post("/delete-homework", 'App\Http\Controllers\Admin\AdminSlideWorkController@deleteHomework');
    Route::post("/update-homework", 'App\Http\Controllers\Admin\AdminSlideWorkController@updateHomework');
    Route::post("/add-homework", 'App\Http\Controllers\Admin\AdminSlideWorkController@addHomework');

    Route::get("/slides", 'App\Http\Controllers\Admin\AdminSlideWorkController@getSlides');
    Route::post("/edit-slide", 'App\Http\Controllers\Admin\AdminSlideWorkController@editSlide');
    Route::post("/delete-slide", 'App\Http\Controllers\Admin\AdminSlideWorkController@deleteSlide');
    Route::post("/update-slide", 'App\Http\Controllers\Admin\AdminSlideWorkController@updateSlide');
    Route::post("/add-slide", 'App\Http\Controllers\Admin\AdminSlideWorkController@addSlide');
    Route::post("/slide-tasks", 'App\Http\Controllers\Admin\AdminSlideWorkController@showSlideTasks');
    Route::post("/slide-task-add", 'App\Http\Controllers\Admin\AdminSlideWorkController@addSlideTask');
    Route::post("/slide-task-edit", 'App\Http\Controllers\Admin\AdminSlideWorkController@editSlideTask');
    Route::post("/slide-task-update", 'App\Http\Controllers\Admin\AdminSlideWorkController@updateSlideTask');
    Route::post("/slide-task-delete", 'App\Http\Controllers\Admin\AdminSlideWorkController@deleteSlideTask');

    Route::post("/lesson-slide", 'App\Http\Controllers\Admin\AdminLessonController@lessonSlide');

    Route::post("/tasks-types", 'App\Http\Controllers\Admin\AdminLessonController@taskTypes');

    Route::post("/general-task", 'App\Http\Controllers\Admin\AdminTaskController@getGeneralTasks');
    Route::post("/add-general-task", 'App\Http\Controllers\Admin\AdminTaskController@addGeneralTask');
    Route::post("/edit-general-task", 'App\Http\Controllers\Admin\AdminTaskController@editGeneralTask');
    Route::post("/update-general-task", 'App\Http\Controllers\Admin\AdminTaskController@addGeneralTask');
    Route::post("/delete-general-task", 'App\Http\Controllers\Admin\AdminTaskController@deleteGeneralTask');

    Route::post("/boolean-task", 'App\Http\Controllers\Admin\AdminTaskController@getBooleanTasks');
    Route::post("/add-boolean-task", 'App\Http\Controllers\Admin\AdminTaskController@addBooleanTask');
    Route::post("/edit-boolean-task", 'App\Http\Controllers\Admin\AdminTaskController@editBooleanTask');
    Route::post("/update-boolean-task", 'App\Http\Controllers\Admin\AdminTaskController@addBooleanTask');
    Route::post("/delete-boolean-task", 'App\Http\Controllers\Admin\AdminTaskController@deleteBooleanTask');

    Route::post("/radio-task", 'App\Http\Controllers\Admin\AdminTaskController@getRadioTasks');
    Route::post("/add-radio-task", 'App\Http\Controllers\Admin\AdminTaskController@addRadioTask');
    Route::post("/edit-radio-task", 'App\Http\Controllers\Admin\AdminTaskController@editRadioTask');
    Route::post("/update-radio-task", 'App\Http\Controllers\Admin\AdminTaskController@addRadioTask');
    Route::post("/delete-radio-task", 'App\Http\Controllers\Admin\AdminTaskController@deleteRadioTask');

    Route::post("/edit-radio-task-answer", 'App\Http\Controllers\Admin\AdminTaskController@editRadioTaskAnswer');
    Route::post("/update-radio-task-answer", 'App\Http\Controllers\Admin\AdminTaskController@addRadioTaskAnswer');
    Route::post("/delete-radio-task-answer", 'App\Http\Controllers\Admin\AdminTaskController@deleteRadioTaskAnswer');



});
