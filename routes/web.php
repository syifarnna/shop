<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome'); 
});

// --- RUTE AUTH (LOGIN, REGISTER, LOGOUT) ---
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- RUTE DASHBOARD ---
// Dilindungi middleware 'auth' (hanya untuk yang sudah login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

// --- RUTE PRODUCTS (RESOURCE) ---
// Dilindungi middleware 'auth' agar tamu tidak bisa melihat/mengedit produk
Route::resource('/products', ProductController::class)->middleware('auth');