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

Route::get('/', function () { return view('welcome');});
Auth::routes();
Route::resource('tasks','TasksController');
Route::get('/home', 'TasksController@index')->name('home');
Route::get('/home/filter/{column}', 'TasksController@filter')->name('filter');
Route::get('/tasks/filter/{column}', 'TasksController@filter');
Route::get('/tasks/finished/get', 'TasksController@getFinished');
Route::get('/tasks/get/{urgency}', 'TasksController@getByUrgency');
Route::get('/tasks/complete/{id}', 'TasksController@completeTask');
