<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\PartnerController;
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

    Route::get('/partners/index', [PartnerController::class, 'index'])->name('partner.index');
    Route::post('/partner', [PartnerController::class, 'store'])->name('partner.store');
    Route::delete('/partner/{partner}', [PartnerController::class, 'destroy'])->name('partner.destroy');
    Route::put('/partner/{partner}', [PartnerController::class, 'update'])->name('partner.update');

    Route::get('/menu-items/index', [MenuItemController::class, 'index'])->name('menu-item.index');
    Route::post('/menu-item', [MenuItemController::class, 'store'])->name('menu-item.store');
    Route::delete('/menu-item/{item}', [MenuItemController::class, 'destroy'])->name('menu-item.destroy');
    Route::put('/menu-item/{item}', [MenuItemController::class, 'update'])->name('menu-item.update');
});

Route::middleware('web')->group(function () {

    Route::get('/reviews', [ReviewController::class, 'all'])->name('review.all');
    Route::get('/review/{review}', [ReviewController::class, 'show'])->name('review.show');

    Route::get('/partners', [PartnerController::class, 'all'])->name('partner.all');
    Route::get('/partner/{partner}', [PartnerController::class, 'show'])->name('partner.show');

    Route::get('/menu-items', [MenuItemController::class, 'all'])->name('menu-item.all');
    Route::get('/menu-item/{item}', [MenuItemController::class, 'show'])->name('menu-item.show');
});
