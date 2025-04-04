<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarController;


Route::middleware('api')->group(function () {
    Route::get('/cars/filter', [CarController::class, 'filter']);
    Route::apiResource('cars', CarController::class);
    Route::apiResource('brands', BrandController::class);
});
