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
Route::get('/users/create', 'UserController@create')->name('recetas.create');
Route::post('/recetas', 'UserController@store')->name('recetas.store');
Route::get('/recetas/{receta}', 'UserController@show')->name('recetas.show');
Route::get('/recetas/{receta}/edit', 'UserController@edit')->name('recetas.edit');
Route::put('/recetas/{receta}', 'UserController@update')->name('recetas.update');
Route::delete('/recetas/{receta}', 'UserController@destroy')->name('recetas.destroy');

Route::get('/home', 'HomeController@index')->name('home');
