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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('upload', 'DatabaseController@index')->name('upload.home');

Route::post('file/upload', 'DatabaseController@store')->name('file.upload');
Route::post('upload', 'DatabaseController@upload')->name('upload');


Route::get('wipe', 'DatabaseController@wipe')->name('database.wipe');
Route::get('results', 'PokerGameController@index')->name('results');
