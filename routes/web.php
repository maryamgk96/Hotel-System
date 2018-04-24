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


Route::get('clients', 'ClientsController@index');
Route::get('data', 'ClientsController@ajaxData');
Route::get('clients/create', 'ClientsController@create');
Route::post('clients','ClientsController@store');
Route::get('clients/{id}/edit', 'ClientsController@edit');
Route::put('clients/{id}', 'ClientsController@update');
Route::delete('clients/{id}/delete', 'ClientsController@destroy');

//manage reservations routes
Route::get('reservations', 'ReservationsController@index');
Route::get('reservationdata', 'ReservationsController@data');
Route::get('reservations/roomsdata', 'ReservationsController@show');
Route::get('reservations/rooms', 'ReservationsController@showrooms');
Route::get('reservations/rooms', 'ReservationsController@showrooms');
Route::get ('reservations/create/{room_id}','ReservationsController@create');
Route::post('reservations/{room_id}','ReservationsController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');




//UserController Routes
Route::get(
    '{role}',
    'UserController@index'
)->name('users.index')->where('role', 'managers|receptionists')->middleware('auth','role:admin|manager|receptionist');

Route::get(
    '{role}/create',
    'UserController@create'
)->name('users.create')->where('role', 'managers|receptionists')->middleware('auth','role:admin|manager');

Route::post(
    '{role}',
    'UserController@store'
)->name('users.store')->where('role', 'managers|receptionists');

Route::get(
    '{role}/{user}',
    'UserController@show'
)->name('users.show')->where('role', 'managers|receptionists')->middleware('auth','role:admin|manager');

Route::get(
    '{role}/{user}/edit',
    'UserController@edit'
)->name('users.edit')->where('role', 'managers|receptionists')->middleware('auth','role:admin|manager');

Route::put(
    '{role}/{user}',
    'UserController@update'
)->name('users.update')->where('role', 'managers|receptionists');

Route::delete(
    '{role}/{user}',
    'UserController@destroy'
)->name('users.destroy')->where('role', 'managers|receptionists');



//manage rooms routes
Route::get('rooms', 'RoomsController@index')->name('rooms.index');
Route::get('roomdata', 'RoomsController@data');
Route::get('rooms/create', 'RoomsController@create');
Route::post('rooms', 'RoomsController@store');
Route::get('rooms/{id}/edit', 'RoomsController@edit');
Route::put('rooms/{id}', 'RoomsController@update');
Route::delete('rooms/{id}', 'RoomsController@destroy');





Route::group(['prefix' => 'clients'], function () {
  Route::get('/login', 'ClientAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'ClientAuth\LoginController@login');
  Route::post('/logout', 'ClientAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'ClientAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'ClientAuth\RegisterController@register');

  Route::post('/password/email', 'ClientAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'ClientAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'ClientAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'ClientAuth\ResetPasswordController@showResetForm');
});
