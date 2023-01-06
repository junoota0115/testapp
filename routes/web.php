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

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/list', 'ProductController@showList')->name('Products');
Route::get('/regist','ProductController@showRegistForm')->name('regist');
Route::post('/regist','ProductController@registSubmit')->name('submit');
