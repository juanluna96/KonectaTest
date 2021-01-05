<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('users/admins', 'UserController@admins')->name('users.admins');
Route::get('users/sellers', 'UserController@sellers')->name('users.sellers');
Route::get('users/clients', 'UserController@clients')->name('users.clients');
Route::get('/users/create', 'UserController@create')->name('users.create');
Route::post('/users/store', 'UserController@store')->name('users.store');
Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit');
Route::put('/users/{user}', 'UserController@update')->name('users.update');
Route::delete('/users/{user}', 'UserController@destroy')->name('users.destroy');

Route::get('/home', 'HomeController@index')->name('home');
