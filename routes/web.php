<?php

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
Route::post('/login','SiteController@login');

Route::get('/', 'SiteController@index')->name('login');

Route::group(['middleware'=>['auth','role:admin']], function() {
    Route::get('/periods', 'PeriodController@index');
    Route::post('/periods', 'PeriodController@store');
    Route::get('/periods/create', 'PeriodController@create');
    Route::get('/periods/search', 'PeriodController@search');
    Route::get('/periods/{period}', 'PeriodController@edit');
    Route::patch('/periods/{period}', 'PeriodController@update');
    Route::post('/periods/{period}/change-status', 'PeriodController@changeStatus');

    Route::get('/users', 'UserController@index');
    Route::get('/users/search', 'UserController@search');

    Route::resource('/departments', 'DepartmentController');
    Route::get('/departments/search', 'DepartmentController@search');

    Route::resource('/levels', 'LevelsController');

    Route::resource('/venues', 'RoomsController');
    Route::patch('/venues/{venue}/activate', 'RoomsController@activate');
});

Route::group(['middleware'=>'auth'], function() {
    Route::get('/dashboard', 'SiteController@dashboard');
    Route::get('/logout', 'SiteController@logout');
    Route::get('/users/{user}/change-password', 'UserController@changePasswordForm');
    Route::post('/users/{user}/change-password', 'UserController@changePassword');

    Route::get('/users/load', 'UserController@showLoad');
    Route::get("/users/{user}", 'UserController@show');
    Route::get('/users/{user}/edit', 'UserController@edit');
    Route::get('/users/{user}/change-password', 'UserController@changePasswordForm');
    Route::post('/users/{user}/change-password', 'UserController@changePassword');
    Route::patch('/users/{user}', 'UserController@update');
    Route::post('/users', 'UserController@store');
    Route::get('/users/create', 'UserController@create');

    Route::get('/classes', 'ClassesController@index');
    Route::get('/classes/{class}/view', 'ClassesController@view');
});

Route::group(['middlwares'=>['auth','role:registrar']], function(){
    Route::get('/students/search', 'StudentController@search');
    Route::resource('/students', 'StudentController');

    Route::get("/enrols/{student}", 'EnrolController@enrol');
    Route::post("/enrols/create-open", 'EnrolController@createOrOpen');
    Route::post('/enrols', 'EnrolController@store');
    Route::get("/enrols/{enrol}/show", 'EnrolController@show');
    Route::post("/enrols/{enrol}/add-class", 'EnrolController@addClass');
    Route::delete("/enrols/{enrol}/remove-class", 'EnrolController@removeClass');

    Route::get('/programs/search', 'ProgramController@search');
    Route::resource('/programs', 'ProgramController');

    Route::get('/courses/search', 'CourseController@search');
    Route::resource('/courses', 'CourseController');

    Route::get('/strands/search', 'StrandController@search');
    Route::resource('/strands', 'StrandController');

});

Route::group(['middleware'=>['auth','role:dean']], function(){
    Route::get('/classes/create', 'ClassesController@create');
    Route::post('/classes', 'ClassesController@store');
    Route::post('/classes/{class}/add-sched', 'ClassesController@addSched');
    Route::get('/classes/{class}/edit', 'ClassesController@edit');
    Route::patch('/classes/{class}', 'ClassesController@update');
    Route::post('/classes/remove-sched', 'ClassesController@removeSched');

    Route::get('/section/search', 'SectionController@search');
    Route::resource('/sections', 'SectionController');
    Route::get('/sections/{section}/add-classes', 'SectionController@addClassesForm');
    Route::post('/sections/{section}/add-classes', 'SectionController@addClasses');
});
