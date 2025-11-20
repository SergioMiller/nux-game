<?php
declare(strict_types=1);

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'showRegisterForm'])->name('auth.register.form');
Route::post('/', [AuthController::class, 'register'])->name('auth.register');
