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

// 商品登録画面表示
Route::get('/regist','ProductController@showRegist')->name('regist');

//商品登録
Route::post('/submit','ProductController@exeSubmit')->name('submit');

// 商品詳細画面表示
Route::get('/product/{id}','ProductController@showDetail')->name('show');

// 商品編集画面表示
Route::get('/product/edit/{id}','ProductController@showEdit')->name('edit');

// 編集登録
Route::post('/product/update','ProductController@exeUpdate')->name('update');