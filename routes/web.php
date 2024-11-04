<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

function utama($view) {
    return view("utama.$view");
}

Route::get('/', function () {
    return utama('index');
});

Route::get('/kontak', function () {
    return utama('kontak');
});

Route::get('/ulasan', function () {
    return utama('ulasan');
});

Route::get('/prasmanan', function () {
    return utama('prasmanan.index');
});

Route::get('/nasikotak', function () {
    return utama('nasikotak.index');
});
