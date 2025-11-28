<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route khusus Admin
    Route::prefix('admin')->group(function () {
        Route::get('/verify-stores', [AdminController::class, 'index'])->name('admin.verify_stores');
        Route::patch('/verify-stores/{store}/approve', [AdminController::class, 'approve'])->name('admin.approve_store');
        Route::patch('/verify-stores/{store}/reject', [AdminController::class, 'reject'])->name('admin.reject_store');
    });

    // === ROUTE SELLER ===
    Route::prefix('seller')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\SellerController::class, 'dashboard'])->name('seller.dashboard');
        
        // Route untuk submit form buat toko
        Route::post('/create-store', [App\Http\Controllers\SellerController::class, 'store'])->name('seller.store_new');
    });
});

require __DIR__.'/auth.php';
