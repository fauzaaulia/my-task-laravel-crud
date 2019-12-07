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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::resource('projects', 'ProjectController');
Route::resource('tasks', 'TaskController');

Route::view('projects/{id}', 'projects.index')->name('projects.id');

Route::get('task/{id}/addtoavaible', 'TaskController@tersedia')->name('tasks.tersedia');
Route::get('task/{id}/addtowork', 'TaskController@dikerjakan')->name('tasks.dikerjakan');
Route::get('task/{id}/addtodone', 'TaskController@selesai')->name('tasks.selesai');
