<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IventarisController;
use App\Http\Controllers\AuthController;


Route::get ('/admin', [IventarisController::class, 'index'])->name('admin');

//Menampilkan halaman login.
Route::get('/auth/login', [AuthController::class, 'index'])->name('auth.login.form');

//Memproses data dari form login yang dikirim pengguna.
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login.process');

//Menampilkan daftar data aset/inventaris di sistem.
Route::get('/data_aset', [IventarisController::class, 'dataAset'])->name('aset.index');

//Menampilkan halaman utama admin atau pengguna setelah login, yaitu Dashboard.
Route::get('/dashboard', [IventarisController::class, 'index'])->name('dashboard');

//Menampilkan halaman “Home” secara langsung tanpa melalui controller.
Route::get('/home', function () {
    return view('home');})->name('home');

//Melakukan logout pengguna, lalu mengarahkan (redirect) kembali ke halaman login.
    Route::get('/logout', function () {session()->flush();
    return redirect()->route('auth.login.form');})->name('logout');
