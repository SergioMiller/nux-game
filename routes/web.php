<?php
declare(strict_types=1);

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login.show');
Route::post('/', [AuthController::class, 'login'])->name('login');
