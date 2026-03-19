<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WaranController;
use App\Http\Controllers\PerbelanjaanController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| 1. LALUAN AWAM / STAFF
|--------------------------------------------------------------------------
*/
// Halaman utama semakan
Route::get('/', [WaranController::class, 'index'])->name('warans.index');

// Route Export diletakkan di luar supaya tidak kacau laluan Admin
Route::get('/warans/export', [WaranController::class, 'export'])->name('warans.export');


/*
|--------------------------------------------------------------------------
| 2. LALUAN PENGURUSAN (ADMIN)
|--------------------------------------------------------------------------
*/
Route::prefix('urus-setia-sstp')->group(function () {

    // --- A. LALUAN LOGIN (MESTI DI ATAS) ---
    // Letakkan login di bahagian paling atas prefix supaya tidak bertembung dengan resource
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // --- B. LALUAN YANG MEMERLUKAN AUTH ---
    Route::middleware(['auth'])->group(function () {
        
        // Dashboard Admin
        Route::get('/dashboard', [WaranController::class, 'adminDashboard'])->name('admin.dashboard');

        // --- C. PENGURUSAN PERBELANJAAN ---
        Route::get('/perbelanjaan/tambah/{waran_id}', [PerbelanjaanController::class, 'create'])->name('perbelanjaan.create');
        Route::post('/perbelanjaan/simpan', [PerbelanjaanController::class, 'store'])->name('perbelanjaan.store');
        Route::get('/perbelanjaan/edit/{id}', [PerbelanjaanController::class, 'edit'])->name('perbelanjaan.edit');
        Route::put('/perbelanjaan/update/{id}', [PerbelanjaanController::class, 'update'])->name('perbelanjaan.update');
        Route::delete('/perbelanjaan/padam/{id}', [PerbelanjaanController::class, 'destroy'])->name('perbelanjaan.destroy');

        // --- D. PENGURUSAN WARAN (MESTI DI BAWAH SEKALI) ---
        // Resource diletakkan di bawah sekali supaya perkataan 'login' atau 'dashboard' 
        // tidak dianggap sebagai ID waran.
        Route::resource('warans', WaranController::class)->except(['index', 'show']);
    });
});