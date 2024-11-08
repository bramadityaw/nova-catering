<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SatuanController;
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

    Route::get('/satuans/index', [SatuanController::class, 'index'])->name('satuan.index');
    Route::post('/satuan', [SatuanController::class, 'store'])->name('satuan.store');
    Route::delete('/satuan/{satuan}', [SatuanController::class, 'destroy'])->name('satuan.destroy');
    Route::put('/satuan/{satuan}', [SatuanController::class, 'update'])->name('satuan.update');

    Route::get('/pakets/index', [PaketController::class, 'index'])->name('paket.index');
    Route::post('/paket', [PaketController::class, 'store'])->name('paket.store');
    Route::put('/paket/{paket}', [PaketController::class, 'update'])->name('paket.update');
    Route::delete('/paket/{paket}', [PaketController::class, 'update'])->name('paket.update');
});

Route::middleware('web')->group(function () {

    Route::get('/reviews', [ReviewController::class, 'all'])->name('review.all');
    Route::get('/review/{review}', [ReviewController::class, 'show'])->name('review.show');

    Route::get('/partners', [PartnerController::class, 'all'])->name('partner.all');
    Route::get('/partner/{partner}', [PartnerController::class, 'show'])->name('partner.show');

    Route::get('/satuans', [SatuanController::class, 'all'])->name('satuan.all');
    Route::get('/satuan/{satuan}', [SatuanController::class, 'show'])->name('satuan.show');

    Route::get('/pakets', [PaketController::class, 'all'])->name('paket.all');
    Route::get('/paket/{paket}', [PaketController::class, 'show'])->name('paket.show');
    Route::get('/paket/{paket}/items', [PaketController::class, 'items'])->name('paket.items');
});
