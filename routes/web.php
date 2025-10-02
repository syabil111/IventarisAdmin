<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IventarisController;

Route::get ('/admin', [IventarisController::class, 'index'])->name('admin');

