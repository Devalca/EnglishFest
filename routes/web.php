<?php

use App\Http\Controllers\HomesController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;

Route::get('/', [HomesController::class, 'home'])->name('home');
Route::get('/contest/{contest}', [HomesController::class, 'contestDetail'])->name('home.contestDetail');
Route::get('/logout', [HomesController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::post('/join', [HomesController::class, 'submitContests'])->name('submitContests');
    Route::get('/repair', function () {
        Artisan::call('storage:link');
        Alert::success('Success', 'Masalah file, dokumen, gambar sedang di perbaiki mohon tunggu sebentar / refresh ulang website');
        return redirect()->route('home');
    })->name('repair');
});