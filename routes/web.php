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

Route::get('/', 'SiteController@index');

Route::group(['middleware'=>'auth'], function() {
    Route::get('/dashboard', 'SiteController@dashboard');
    Route::get('/logout', 'SiteController@logout');

    Route::get('/students/search', 'StudentController@search')->middleware('role:registrar');
    Route::resource('/students', 'StudentController')->middleware(['role:registrar']);

    Route::get('/section/search', 'SectionController@search')->middleware(['role:registrar']);
    Route::resource('/sections', 'SectionController')->middleware(['role:registrar']);

    Route::get('/periods', 'PeriodController@index')->middleware(['role:admin']);
    Route::post('/periods', 'PeriodController@store')->middleware(['role:admin']);
    Route::get('/periods/create', 'PeriodController@create')->middleware(['role:admin']);
    Route::get('/periods/search', 'PeriodController@search')->middleware(['role:admin']);
    Route::get('/periods/{period}', 'PeriodController@edit')->middleware(['role:admin']);
    Route::patch('/periods/{period}', 'PeriodController@update')->middleware(['role:admin']);
    Route::post('/periods/{period}/change-status', 'PeriodController@changeStatus')->middleware(['role:admin']);
});
