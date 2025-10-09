<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IventarisController;
use App\Http\Controllers\AuthController;


Route::get ('/admin', [IventarisController::class, 'index'])->name('admin');
Route::get('/auth/login', [AuthController::class, 'index'])->name('auth.login.form');
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login.process');
Route::get('/data_aset', [IventarisController::class, 'dataAset'])->name('aset.index');
Route::get('/dashboard', [IventarisController::class, 'index'])->name('dashboard');

Route::get('/home', function () {
    return view('home');})->name('home');

    Route::get('/logout', function () {session()->flush();
    return redirect()->route('auth.login.form');})->name('logout');
