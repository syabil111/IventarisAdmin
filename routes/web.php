<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AsetController;
use Illuminate\Support\Facades\Route;

// Route untuk halaman root "/" - TAMPILKAN LANGSUNG LOGIN
Route::get('/', [AuthController::class, 'showLogin'])->name('login');

// Route authentication
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route yang membutuhkan authentication
Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    // Kategori Routes
    Route::resource('kategori', KategoriController::class);
    
    // Aset Routes
    Route::resource('aset', AsetController::class);
});