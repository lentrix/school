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
});

Route::group(['middleware'=>'auth'], function() {
    Route::get('/dashboard', 'SiteController@dashboard');
    Route::get('/logout', 'SiteController@logout');
    Route::get('/users/{user}/change-password', 'UserController@changePasswordForm');
    Route::post('/users/{user}/change-password', 'UserController@changePassword');

    Route::get("/users/{user}", 'UserController@show');
    Route::get('/users/{user}/edit', 'UserController@edit');
    Route::get('/users/{user}/change-password', 'UserController@changePasswordForm');
    Route::post('/users/{user}/change-password', 'UserController@changePassword');
    Route::patch('/users/{user}', 'UserController@update');
    Route::post('/users', 'UserController@store');
    Route::get('/users/create', 'UserController@create');
});

Route::group(['middlwares'=>['auth','role:registrar']], function(){
    Route::get('/students/search', 'StudentController@search');
    Route::resource('/students', 'StudentController');

    Route::get('/section/search', 'SectionController@search');
    Route::resource('/sections', 'SectionController');

    Route::get("/enrols/{student}", 'EnrolController@enrol');
    Route::post('/enrols', 'EnrolController@store');
    Route::get("/enrols/{enrol}/show", 'EnrolController@show');
});
