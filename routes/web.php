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
Route::get('floors', 'FloorsController@index')->name('floors.index')->middleware('auth','role:admin|manager','forbid-banned-user');
Route::get('getFloorsData', 'AjaxController@floorsDataAjax');
Route::get('floors/create', 'FloorsController@create')->middleware('auth','role:admin|manager','forbid-banned-user');
Route::post('floors', 'FloorsController@store');
Route::get('floors/{id}/edit', 'FloorsController@edit')->middleware('auth','role:admin|manager','forbid-banned-user');
Route::put('floors/{id}', 'FloorsController@update');
Route::delete('floors/{id}', 'FloorsController@destroy');


//manage clients routes
Route::get('clients', 'ClientsController@index');
Route::get('clients/myclients', 'ClientsController@showMyClients')->middleware('auth','role:admin|manager|receptionist','forbid-banned-user');
Route::get('clientsdata', 'AjaxController@clientsDataAjax');
Route::get('approvedClients', 'AjaxController@approvedClients')->middleware('auth','role:admin|manager|receptionist','forbid-banned-user');
Route::get('clients/create', 'ClientsController@create')->middleware('auth','role:admin|manager','forbid-banned-user');
Route::post('clients','ClientsController@store');
Route::get('clients/{id}/edit', 'ClientsController@edit')->middleware('auth','role:admin|manager','forbid-banned-user');
Route::put('clients/{id}', 'ClientsController@update');
Route::get('profilee/{id}/edit', 'ClientsController@editprofile')->middleware('auth:client');
Route::put('profilee/{id}', 'ClientsController@updateprofile');
Route::get('clients/{id}/approve','ClientsController@approve')->middleware('auth','role:admin|manager|receptionist','forbid-banned-user');;

Route::delete('clients/delete', 'ClientsController@destroy')->name('client.delete');


//manage reservations routes
Route::get('reservations', 'ReservationsController@index');
Route::get('reservationdata', 'AjaxController@reservationDataAjax');
Route::get('reservations/roomsdata', 'AjaxController@showRoomAjaxData');
Route::get('reservations/rooms', 'ReservationsController@show')->middleware('auth:client');
Route::get ('reservations/create/{room_id}','ReservationsController@create')->middleware('auth:client');
Route::post('reservations/{room_id}','ReservationsController@store');
Route::get('allreservations', 'AjaxController@reservationsDataAjax');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

        
//UserController Routes
Route::get(
    '{role}',
    'UserController@index'
)->name('users.index')->where('role', 'managers|receptionists')->middleware('web','role:admin|manager|receptionist','forbid-banned-user');
Route::get('getManagersData', 'AjaxController@managersDataAjax');
Route::get('getReceptionistsData', 'AjaxController@receptionistsDataAjax');
Route::get('deleteData/{id}', 'AjaxController@managersDataAjax');
Route::get(
    '{role}/create',
    'UserController@create'
)->name('users.create')->where('role', 'managers|receptionists')->middleware('auth','role:admin|manager','forbid-banned-user');

Route::post(
    '{role}',
    'UserController@store'
)->name('users.store')->where('role', 'managers|receptionists');

Route::get(
    '{role}/{user}/edit',
    'UserController@edit'
)->name('users.edit')->where('role', 'managers|receptionists')->middleware('auth','role:admin|manager','forbid-banned-user');

Route::get(
    'profile/{user}/edit',
    'UserController@editProfile'
)->name('users.editProfile')->middleware('auth');


Route::put(
    'profile/{user}',
    'UserController@updateProfile'
)->name('users.updateProfile');


Route::put(
    '{role}/{user}',
    'UserController@update'
)->name('users.update')->where('role', 'managers|receptionists');

Route::delete(
    'users/{user}',
    'UserController@destroy'
)->name('users.destroy');

Route::get(
    'ban/{user}',
    'UserController@ban'
)->name('users.ban');

Route::get(
    'unban/{user}',
    'UserController@unban'
)->name('users.unban');
Route::get('ERROR/{id}', 'ErrorController@unauthorized');

//manage rooms routes
Route::get('rooms', 'RoomsController@index')->name('rooms.index')->middleware('auth','role:admin|manager','forbid-banned-user');
Route::get('getRoomsData', 'AjaxController@roomsDataAjax');
Route::get('rooms/create', 'RoomsController@create')->middleware('auth','role:admin|manager','forbid-banned-user');
Route::post('rooms', 'RoomsController@store');
Route::get('rooms/{id}/edit', 'RoomsController@edit')->middleware('auth','role:admin|manager','forbid-banned-user');
Route::put('rooms/{id}', 'RoomsController@update');
Route::delete('rooms/{id}', 'RoomsController@destroy');




//client auth routs
Route::group(['prefix' => 'client'], function () {
  Route::get('/login', 'ClientAuth\LoginController@showLoginForm')->name('clientlogin')->middleware('guest:web');
  Route::post('/login', 'ClientAuth\LoginController@login');
  Route::post('/logout', 'ClientAuth\LoginController@logout')->name('clientlogout');

  Route::get('/register', 'ClientAuth\RegisterController@showRegistrationForm')->name('clientregister')->middleware('guest:web');
  Route::post('/register', 'ClientAuth\RegisterController@register');

  Route::post('/password/email', 'ClientAuth\ForgotPasswordController@sendResetLinkEmail')->name('clientpassword.request');
  Route::post('/password/reset', 'ClientAuth\ResetPasswordController@reset')->name('clientpassword.email');
  Route::get('/password/reset', 'ClientAuth\ForgotPasswordController@showLinkRequestForm')->name('clientpassword.reset');
  Route::get('/password/reset/{token}', 'ClientAuth\ResetPasswordController@showResetForm');
});

Route::get(
    'statistics',
    'ChartsController@index'
)->middleware('auth','role:admin|manager','forbid-banned-user');

// Route for export/download tabledata to .csv, .xls or .xlsx
Route::get('downloadExcel/{type}', 'ExcelsheetsController@downloadExcel');