<?php

use App\Http\Controllers\AdminCarController;
use App\Http\Controllers\AdminBrandController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Models\Car;
use Illuminate\Http\Request;

// Página principal
Route::get('/', [PageController::class, 'home'])->name('home');

// Catálogo público
Route::get('/cars', function () {
    $cars = Car::with('brand')->paginate(10);
    return view('index', compact('cars'));
})->name('index');

// Mostrar formulario de login
Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin.login');

Route::post('/admin/login', function (Request $request) {
    if ($request->password === '1234') {
        session(['admin_authenticated' => true]);
        return redirect()->route('admin.cars.index');
    } else {
        return back()->with('error', 'Contraseña incorrecta.');
    }
})->name('admin.login.attempt');

// Administración de autos
Route::prefix('admin/cars')->name('admin.cars.')->group(function () {
    Route::get('/', [AdminCarController::class, 'index'])->name('index');
    Route::get('/create', [AdminCarController::class, 'create'])->name('create');
    Route::post('/', [AdminCarController::class, 'store'])->name('store');
    Route::get('/{car}/edit', [AdminCarController::class, 'edit'])->name('edit');
    Route::put('/{car}', [AdminCarController::class, 'update'])->name('update');
    Route::delete('/{car}', [AdminCarController::class, 'destroy'])->name('destroy');
});

// (Opcional) administración de marcas si quieres usarla
Route::prefix('admin/brands')->name('admin.brands.')->group(function () {
    Route::get('/', [AdminBrandController::class, 'index'])->name('index');
    Route::get('/create', [AdminBrandController::class, 'create'])->name('create');
    Route::post('/', [AdminBrandController::class, 'store'])->name('store');
    Route::get('/{brand}/edit', [AdminBrandController::class, 'edit'])->name('edit');
    Route::put('/{brand}', [AdminBrandController::class, 'update'])->name('update');
    Route::delete('/{brand}', [AdminBrandController::class, 'destroy'])->name('destroy');
});
