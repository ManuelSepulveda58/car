<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Brand;
use Illuminate\Http\Request;

class AdminCarController extends Controller
{
    // Listar todos los autos (modo administración)
    public function index()
    {
        $cars = Car::with('brand')->paginate(10);
        return view('admin.cars.index', compact('cars'));
    }

    // Mostrar formulario para crear un auto
    public function create()
    {
        $brands = Brand::all();
        return view('admin.cars.create', compact('brands'));
    }

    // Guardar un nuevo auto en la base de datos
    public function store(Request $request)
    {
        $validated = $request->validate([
            'model' => 'required|string|max:255',
            'brand_id' => 'required|exists:brands,id',
            'price' => 'required|numeric|min:0',
            'kilometraje' => 'required|numeric|min:0',
        ]);

        Car::create($validated);

        return redirect()->route('admin.cars.index')
                         ->with('success', 'Auto creado correctamente.');
    }

    // Mostrar formulario de edición
    public function edit(Car $car)
    {
        $brands = Brand::all();
        return view('admin.cars.edit', compact('car', 'brands'));
    }

    // Actualizar el auto
    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'model' => 'required|string|max:255',
            'brand_id' => 'required|exists:brands,id',
            'price' => 'required|numeric|min:0',
            'kilometraje' => 'required|numeric|min:0',
        ]);

        $car->update($validated);

        return redirect()->route('admin.cars.index')
                         ->with('success', 'Auto actualizado correctamente.');
    }

    // Eliminar auto
    public function destroy(Car $car)
    {
        $car->delete();

        return redirect()->route('admin.cars.index')
                         ->with('success', 'Auto eliminado correctamente.');
    }
}
