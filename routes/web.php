<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FeedbackController as AdminFeedbackController;
use App\Http\Controllers\Admin\RentalController as AdminRentalController;
use App\Http\Controllers\Admin\VehicleController as AdminVehicleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [VehicleController::class, 'index'])->name('vehicles.index');

// เฉพาะผู้ที่ยังไม่ล็อกอิน (guest)
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

// ต้องล็อกอินก่อน
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    Route::get('/my-bookings', [RentalController::class, 'index'])->name('rentals.index');
    Route::get('/vehicles/{vehicle}/rent', [RentalController::class, 'create'])->name('rentals.create');
    Route::post('/vehicles/{vehicle}/rent', [RentalController::class, 'store'])->name('rentals.store');

    Route::get('/rentals/{rental}/review', [FeedbackController::class, 'create'])->name('feedbacks.create');
    Route::post('/rentals/{rental}/review', [FeedbackController::class, 'store'])->name('feedbacks.store');
});

// ===== Admin (ต้องล็อกอิน + เป็น admin) =====
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/vehicles', [AdminVehicleController::class, 'index'])->name('vehicles.index');
    Route::get('/vehicles/create', [AdminVehicleController::class, 'create'])->name('vehicles.create');
    Route::post('/vehicles', [AdminVehicleController::class, 'store'])->name('vehicles.store');
    Route::get('/vehicles/{vehicle}/edit', [AdminVehicleController::class, 'edit'])->name('vehicles.edit');
    Route::put('/vehicles/{vehicle}', [AdminVehicleController::class, 'update'])->name('vehicles.update');
    Route::patch('/vehicles/{vehicle}/status', [AdminVehicleController::class, 'updateStatus'])->name('vehicles.status');
    Route::delete('/vehicles/{vehicle}', [AdminVehicleController::class, 'destroy'])->name('vehicles.destroy');

    Route::get('/rentals', [AdminRentalController::class, 'index'])->name('rentals.index');
    Route::patch('/rentals/{rental}/status', [AdminRentalController::class, 'updateStatus'])->name('rentals.status');

    Route::get('/feedbacks', [AdminFeedbackController::class, 'index'])->name('feedbacks.index');
    Route::delete('/feedbacks/{feedback}', [AdminFeedbackController::class, 'destroy'])->name('feedbacks.destroy');
});
