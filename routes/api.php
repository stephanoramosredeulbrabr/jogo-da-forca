<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WordController;
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

Route::resource('category', CategoryController::class)->only('index');
Route::resource('word', WordController::class)->only('index');

Route::prefix('category/{category}')->group(function () {
    Route::get('word', [CategoryController::class, 'indexWord']);
});

Route::middleware('auth:api')->group(function () {
    Route::get('user', fn(Request $request) => $request->user());

    Route::resource('category', CategoryController::class)->except('index', 'create', 'edit');
    Route::resource('word', WordController::class)->except('index', 'store', 'create', 'edit');

    Route::prefix('category/{category}')->group(function () {
        Route::post('word', [CategoryController::class, 'storeWord']);
    });
});
