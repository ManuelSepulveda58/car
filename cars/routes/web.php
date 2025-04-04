<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Models\Car;

Route::get('/', [PageController::class, 'home'])->name('home');


Route::get('/cars', function () {
    $cars = Car::with('brand') // Carga la relación 'brand' para evitar N+1
               ->paginate(10); // Paginación de 10 autos por página
    
    return view('index', compact('cars'));
})->name('index');
