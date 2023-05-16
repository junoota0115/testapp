<?php

use Illuminate\Http\Request;
use App\Http\Controllers\SalesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
});

// Route::apiResource('sales','SalesController');

Route::middleware(['middleware' => 'api'])->group(function () {
    // # 商品id追加
    // Route::get('sales/update/{id}', 'SalesController@update'); 
    Route::post('sales/update/{id}', 'SalesController@update'); 
    // # Salesテーブルデータ表示
    Route::get('/sales','SalesController@index');

});
