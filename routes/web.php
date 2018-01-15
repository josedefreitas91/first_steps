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

Route::get('/usuarios', 'UserController@index')
	->name('users');

Route::get('/usuarios/nuevo', 'UserController@create')
	->name('users.create');

Route::get('/usuarios/{id}/edit', 'UserController@edit')
	->where('id', '[0-9]+')
	->name('users.edit');

Route::get('/usuarios/{user}', 'UserController@show')
	->where('user', '[0-9]+')
	->name('users.show');


Route::get('/saludo/{nombre}/{nickname?}', 'WelcomeUserController');

