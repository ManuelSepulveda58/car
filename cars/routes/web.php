<?php
use App\Http\Controllers\AdminBrandController;
use App\Http\Controllers\AdminCarController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Models\Car;

Route::get('/', [PageController::class, 'home'])->name('home');


Route::get('/cars', function () {
    $cars = Car::with('brand') // Carga la relación 'brand' para evitar N+1
               ->paginate(10); // Paginación de 10 autos por página
    
    return view('index', compact('cars'));
})->name('index');

// Grupo de rutas para administración de autos
Route::prefix('admin/cars')->name('admin.cars.')->group(function () {
    Route::get('/', [AdminCarController::class, 'index'])->name('index');
    Route::get('/create', [AdminCarController::class, 'create'])->name('create');
    Route::post('/', [AdminCarController::class, 'store'])->name('store');
    Route::get('/{car}/edit', [AdminCarController::class, 'edit'])->name('edit');
    Route::put('/{car}', [AdminCarController::class, 'update'])->name('update');
    Route::delete('/{car}', [AdminCarController::class, 'destroy'])->name('destroy');
});

// Grupo de rutas para administración de brands
Route::prefix('admin/brands')->name('admin.brands.')->group(function () {
    Route::get('/', [AdminBrandController::class, 'index'])->name('index');
    Route::get('/create', [AdminBrandController::class, 'create'])->name('create');
    Route::post('/', [AdminBrandController::class, 'store'])->name('store');
    Route::get('/{brand}/edit', [AdminBrandController::class, 'edit'])->name('edit');
    Route::put('/{brand}', [AdminBrandController::class, 'update'])->name('update');
    Route::delete('/{brand}', [AdminBrandController::class, 'destroy'])->name('destroy');
});