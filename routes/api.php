<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\WordController;
use App\Http\Controllers\RankingController;
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
Route::resource('question', QuestionController::class)->only('index');
Route::resource('answer', AnswerController::class)->only('index');
Route::resource('ranking', RankingController::class)->only(['index','store']);

Route::prefix('category/{category}')->group(function () {
    Route::get('word', [CategoryController::class, 'indexWord']);
});

Route::prefix('question/{question}')->group(function () {
    Route::get('answer', [QuestionController::class, 'indexAnswer']);
});

Route::prefix('game')->group(function () {
    Route::post('letter', [WordController::class, 'findLetter']);
    Route::get('word/{category?}', [CategoryController::class, 'getWord']);
    Route::get('question', [QuestionController::class, 'getQuestion']);
    Route::post('question/answer', [AnswerController::class, 'checkAnswer']);
});

Route::middleware('auth:api')->group(function () {
    Route::get('user', fn(Request $request) => $request->user());

    Route::resource('category', CategoryController::class)->except('index', 'create', 'edit');
    Route::resource('word', WordController::class)->except('index', 'store', 'create', 'edit');

    Route::resource('question', QuestionController::class)->except('index', 'create', 'edit');
    Route::resource('answer', AnswerController::class)->except('index', 'store', 'create', 'edit');

    Route::prefix('category/{category}')->group(function () {
        Route::post('word', [CategoryController::class, 'storeWord']);
    });

    Route::prefix('question/{question}')->group(function () {
        Route::post('answer', [QuestionController::class, 'storeAnswer']);
    });
});
