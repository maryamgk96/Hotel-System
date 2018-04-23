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
//manage floors routes
Route::get('floors', 'FloorsController@index')->name('floors.index');
Route::get('floordata', 'FloorsController@data');
Route::get('floors/create', 'FloorsController@create');
Route::post('floors', 'FloorsController@store');
Route::get('floors/{id}/edit', 'FloorsController@edit');
Route::put('floors/{id}', 'FloorsController@update');
Route::delete('floors/{id}', 'FloorsController@destroy');
//manage reservations routes
Route::get('reservations', 'ReservationsController@index');
Route::get('reservationdata', 'ReservationsController@data');
Route::get ('reservations/create','ReservationsController@create');
Route::post('reservations','ReservationsController@store');


//manage rooms routes
Route::get('rooms', 'RoomsController@index')->name('rooms.index');
Route::get('roomdata', 'RoomsController@data');
Route::get('rooms/create', 'RoomsController@create');
Route::post('rooms', 'RoomsController@store');
Route::get('rooms/{id}/edit', 'RoomsController@edit');
Route::put('rooms/{id}', 'RoomsController@update');
Route::delete('rooms/{id}', 'RoomsController@destroy');
