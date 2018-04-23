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
});
Route::get('floors', 'FloorsController@index')->name('floors.index');
Route::get('floordata', 'FloorsController@data');
Route::get('floors/create', 'FloorsController@create');
Route::post('floors', 'FloorsController@store');
Route::get('floors/{id}/edit', 'FloorsController@edit');
Route::put('floors/{id}', 'FloorsController@update');
Route::delete('floors/{id}', 'FloorsController@destroy');