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

Route::get('/', [\App\Http\Controllers\IndexController::class, 'index']);
Route::get('/year', [\App\Http\Controllers\IndexController::class, 'index']);
Route::get('/year/{year}', [\App\Http\Controllers\IndexController::class, 'index']);

Route::get('/catalogue/{magaid}/date/{date}', [\App\Http\Controllers\CatalogueController::class, 'index']);
Route::get('/article/{article_id}/magaid/{magaid}', [\App\Http\Controllers\CatalogueController::class, 'article']);

Route::get('/search', [\App\Http\Controllers\SearchController::class, 'index']);

