<?php
declare(strict_types=1);

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;

#Register
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login.page');
Route::post('/', [AuthController::class, 'login'])->name('auth.login');

Route::group(['middleware' => ['auth']], static function () {
    #Link
    Route::post('/link/{ref}/regenerate', [LinkController::class, 'regenerate'])->name('link.regenerate');
    Route::post('/link/{ref}/deactivate', [LinkController::class, 'deactivate'])->name('link.deactivate');
    #Game
    Route::get('/game/{ref}', [GameController::class, 'index'])->name('game.index');
    Route::post('/game/{ref}', [GameController::class, 'play'])->name('game.play');
    Route::get('/game/{ref}/history', [GameController::class, 'history'])->name('game.history');
});
