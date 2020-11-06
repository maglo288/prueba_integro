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
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('films', 'FilmController@store')->middleware('role');

Route::get('films/film_all', [
    'as' => 'films.film_all',
    'uses' => 'FilmController@film_all'
]);

Route::get('films/film_all', [
    'as' => 'films.film_all',
    'uses' => 'FilmController@film_all'
]);

Route::get('films/info','FilmController@info')->middleware('role');

	Route::put('films/{id}', [
		'uses' => 'FilmController@update'
	]);