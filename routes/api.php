<?php

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
Route::match(['get'], '/synchronize', [App\Http\Controllers\Api\SynchronizeController::class, 'index']);
Route::match(['get'], '/wash_article', [App\Http\Controllers\Api\SynchronizeController::class, 'washArticle']);

//Route::match(['get','post'], '/synchronize', 'Api\SynchronizeController@index');
