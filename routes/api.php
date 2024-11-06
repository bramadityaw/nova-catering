<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/reviews/index', [ReviewController::class, 'index'])->name('review.index');
    Route::post('/review', [ReviewController::class, 'store'])->name('review.store');
    Route::post('/review/{review}/hide', [ReviewController::class, 'conceal'])->name('review.conceal');
    Route::post('/review/{review}/show', [ReviewController::class, 'reveal'])->name('review.reveal');
    Route::delete('/review/{review}', [ReviewController::class, 'destroy'])->name('review.destroy');

});

Route::middleware('web')->group(function () {

    Route::get('/reviews', [ReviewController::class, 'all'])->name('review.all');
    Route::get('/review/{review}', [ReviewController::class, 'show'])->name('review.show');

});
