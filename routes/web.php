<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeluhanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NotifikasiController;

// Redirect halaman utama
Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->role === 'admin') {
            return redirect('/admin/dashboard');
        }
        return redirect('/dashboard');
    }
    return redirect('/login');
});

// Dashboard Mahasiswa
Route::get('/dashboard', [KeluhanController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Route Keluhan Mahasiswa
Route::middleware(['auth'])->group(function () {
    Route::get('/keluhan/buat', [KeluhanController::class, 'create'])->name('keluhan.create');
    Route::post('/keluhan', [KeluhanController::class, 'store'])->name('keluhan.store');
    Route::get('/keluhan/{id}', [KeluhanController::class, 'show'])->name('keluhan.show');
});

// Route Admin
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/keluhan', [AdminController::class, 'keluhanList'])->name('admin.keluhan');
    Route::get('/keluhan/{id}', [AdminController::class, 'keluhanDetail'])->name('admin.keluhan.detail');
    Route::post('/keluhan/{id}/update', [AdminController::class, 'updateStatus'])->name('admin.keluhan.update');
    Route::get('/laporan', [AdminController::class, 'laporan'])->name('admin.laporan');
    Route::get('/laporan/export-pdf', [AdminController::class, 'exportPdf'])->name('admin.laporan.pdf'); // ← tambahkan ini
});

// Notifikasi
Route::middleware('auth')->group(function () {
    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');
    Route::post('/notifikasi/{id}/baca', [NotifikasiController::class, 'markRead'])->name('notifikasi.baca');
});

// Auth routes (Breeze)
require __DIR__.'/auth.php';