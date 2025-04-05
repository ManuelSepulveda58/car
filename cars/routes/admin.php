use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminCarController;

Route::get('/cars', [AdminCarController::class, 'index'])->name('admin.cars.index');
Route::get('/cars/create', [AdminCarController::class, 'create'])->name('admin.cars.create');
Route::post('/cars', [AdminCarController::class, 'store'])->name('admin.cars.store');
Route::get('/cars/{id}/edit', [AdminCarController::class, 'edit'])->name('admin.cars.edit');
Route::put('/cars/{id}', [AdminCarController::class, 'update'])->name('admin.cars.update');
Route::delete('/cars/{id}', [AdminCarController::class, 'destroy'])->name('admin.cars.destroy');