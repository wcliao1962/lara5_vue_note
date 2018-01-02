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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'NoteController@api');
Route::get('/api', 'NoteController@index');
Route::resource('vuenotes','NoteController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('dogs','DogsController');