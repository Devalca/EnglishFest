<?php

use App\Http\Controllers\HomesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomesController::class, 'home'])->name('home');
Route::get('/contest/{contest}', [HomesController::class, 'contestDetail'])->name('home.contestDetail');
Route::get('/logout', [HomesController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::post('/join', [HomesController::class, 'submitContests'])->name('submitContests');
});