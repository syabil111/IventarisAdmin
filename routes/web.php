<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
// routes/web.php
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');


Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    // Tambahkan route lainnya di sini
});

// Pastikan route resource ada
Route::resource('kategori', KategoriController::class);

Route::get('/home', function() {
    return view('home');
})->name('home');
