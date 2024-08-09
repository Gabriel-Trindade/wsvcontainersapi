<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContainerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\InspectionController;

    Route::resource('containers', ContainerController::class);
    Route::resource('users', UserController::class);
    Route::post('/users', [UserController::class, 'create']);
    Route::post('/users/login', [UserController::class, 'login']);
    Route::resource('customers', CustomerController::class);
    Route::resource('rentals', RentalController::class);
    Route::resource('inspections', InspectionController::class);