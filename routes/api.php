<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    return $request->user();
});

Route::resource('customer', 'CustomerController');
Route::resource('room', 'RoomController');
Route::put('transaction/{transaction}/payment', 'TransactionController@update_payment')->name('transaction.update_payment');
Route::resource('transaction', 'TransactionController');