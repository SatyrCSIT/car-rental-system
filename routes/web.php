<?php

use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [VehicleController::class, 'index'])->name('vehicles.index');
