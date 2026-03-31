<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WaranController;
use App\Http\Controllers\PerbelanjaanController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| 1. LALUAN AWAM / STAFF
|--------------------------------------------------------------------------
*/
Route::get('/', [WaranController::class, 'index'])->name('warans.index');
Route::get('/warans/export', [WaranController::class, 'export'])->name('warans.export');

/*
|--------------------------------------------------------------------------
| 2. LALUAN PENGURUSAN (ADMIN)
|--------------------------------------------------------------------------
*/
Route::prefix('urus-setia-sstp')->group(function () {

    // --- A. LALUAN LOGIN ---
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // --- B. LALUAN YANG MEMERLUKAN AUTH ---
    Route::middleware(['auth'])->group(function () {
        
        Route::get('/dashboard', [WaranController::class, 'adminDashboard'])->name('admin.dashboard');

        // --- C. PENGURUSAN PERBELANJAAN ---
        Route::get('/perbelanjaan/tambah/{waran_id}', [PerbelanjaanController::class, 'create'])->name('perbelanjaan.create');
        Route::post('/perbelanjaan/simpan', [PerbelanjaanController::class, 'store'])->name('perbelanjaan.store');
        Route::get('/perbelanjaan/edit/{id}', [PerbelanjaanController::class, 'edit'])->name('perbelanjaan.edit');
        Route::put('/perbelanjaan/update/{id}', [PerbelanjaanController::class, 'update'])->name('perbelanjaan.update');
        Route::delete('/perbelanjaan/padam/{id}', [PerbelanjaanController::class, 'destroy'])->name('perbelanjaan.destroy');

        // --- D. PENGURUSAN WARAN ---
        Route::resource('warans', WaranController::class)->except(['index', 'show']);
    });
});

/*
|--------------------------------------------------------------------------
| 3. LALUAN RESET PASSWORD (PAKSA)
|--------------------------------------------------------------------------
*/
Route::get('/paksa-reset-password', function () {
    $user = User::where('email', 'jpnperak.sstp@moe.gov.my')->first();

    if ($user) {
        $user->update([
            'password' => Hash::make('Maizatul@8680')
        ]);
        return "Berjaya! Password sekarang: Maizatul@8680. Sila cuba login.";
    }

    return "User tak jumpa dalam database!";
});