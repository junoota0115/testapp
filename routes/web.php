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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/home', 'HomeController@index')->name('home');
//商品一覧画面
Route::get('/', 'ProductController@showIndex')->name('Products');
Auth::routes();

// 商品登録画面表示
Route::get('/create','ProductController@showCreate')->name('create')->middleware('auth');

//商品登録
Route::post('/submit','ProductController@exeSubmit')->name('submit')->middleware('auth');

// 商品詳細画面表示
Route::get('/product/{id}','ProductController@showDetail')->name('show');

// 商品編集画面表示
Route::get('/product/edit/{id}','ProductController@showEdit')->name('edit')->middleware('auth');

// 編集登録
Route::post('/product/update','ProductController@exeUpdate')->name('update')->middleware('auth');

// 商品削除
Route::get('/product/delete/{id}','ProductController@showDelete')->name('delete')->middleware('auth');