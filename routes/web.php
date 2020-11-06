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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', function(){

        return view('home');
    });
    /*Route::get('/', function () {
    });*/
    Route::post('films', 'App\Http\Controllers\FilmController@store');
    
    Route::get('films/film_all', [
        'as' => 'films.film_all',
        'uses' => 'App\Http\Controllers\FilmController@film_all'
    ]);
    
    Route::get('films/film_all', [
        'as' => 'films.film_all',
        'uses' => 'App\Http\Controllers\FilmController@film_all'
    ]);
    
    Route::get('films/info/{id}',[
		'uses' => 'App\Http\Controllers\FilmController@info'
	]);
    
    Route::put('films/{id}', [
        'uses' => 'App\Http\Controllers\FilmController@update'
    ]);
    Route::delete('films/{id}',[
        'uses' => 'App\Http\Controllers\FilmController@destroy'
    ]);
    Route::get('/users', [App\Http\Controllers\UsersController::class, 'index'])->name('users');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('users', 'App\Http\Controllers\UsersController@store');
    
    Route::get('users/user_all', [
        'as' => 'users.user_all',
        'uses' => 'App\Http\Controllers\UsersController@user_all'
    ]);
    
    Route::get('users/user_all', [
        'as' => 'users.user_all',
        'uses' => 'App\Http\Controllers\UsersController@user_all'
    ]);
    
    Route::get('users/info/{id}',[
		'uses' => 'App\Http\Controllers\UsersController@info'
	]);
    
    Route::put('users/{id}', [
        'uses' => 'App\Http\Controllers\UsersController@update'
    ]);
    Route::delete('users/{id}',[
        'uses' => 'App\Http\Controllers\UsersController@destroy'
    ]);