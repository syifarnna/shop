<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome'); // Halaman awal bawaan Laravel
});

// Rute untuk Login & Logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Rute untuk Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Contoh halaman yang hanya bisa diakses kalau SUDAH LOGIN (dilindungi middleware 'auth')
Route::get('/dashboard', function () {
    return 'Selamat datang di Dashboard! Ini halaman rahasia.';
})->middleware('auth');