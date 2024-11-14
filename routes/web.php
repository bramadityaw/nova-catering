<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaketController;


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
if (! function_exists('utama'))
{
    function utama($view) {
        return view("utama.$view");
    }
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

Route::get('/nasikotak/detail', function () {
    return utama('nasikotak.show');
});

Route::get('/prasmanan/detail', function () {
    return utama('prasmanan.show');
});


if (! function_exists('admin'))
{
    function admin($view) {
        return view("admin.$view");
    }
}

Route::get('/login', function () {
    return admin('login');
});

Route::get('/admin/prasmanan', function () {
    return admin('prasmanan');
});

Route::get('/admin/edit/prasmanan', function () {
    return admin('add_prasmanan');
});

Route::get('/admin/naskot', function () {
    return admin('naskot');
});

Route::get('/admin/edit/naskot', function () {
    return admin('add_naskot');
});

Route::get('/admin/ulasan', function () {
    return admin('ulasan');
});

Route::get('/admin/account', function () {
    return admin('account');
});

Route::get('/admin/isimenu', function () {
    return admin('isi_menu');
});

Route::get('/admin/edit/isimenu', function () {
    return admin('add_isimenu');
});


Route::post('/admin/paket', [PaketController::class, 'store'])->name('admin.paket.store');

Route::get('/dashboard', function () {
    return admin('dashboard'); // Ensure you have a corresponding view
})->name('dashboard'); // Name the route


