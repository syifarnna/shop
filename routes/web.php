<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController; // Jangan lupa panggil ProductController-nya

Route::get('/', function () {
    return view('welcome'); 
});

// --- RUTE AUTH (LOGIN & REGISTER) ---
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- RUTE DASHBOARD ---
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

// --- RUTE PRODUCTS (RESOURCE) ---
// Gunakan Route::resource agar index, create, store, edit, update, dan destroy otomatis terhubung!
// Cukup tambahkan ->middleware('auth') di belakangnya
Route::resource('/products', ProductController::class)->middleware('auth');