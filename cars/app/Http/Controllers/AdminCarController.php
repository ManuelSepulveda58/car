<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Brand;
use Illuminate\Http\Request;

class AdminCarController extends Controller
{
    /**
     * Muestra un listado paginado de autos junto con su marca .
     */
    public function index()
    {
        // Carga los autos con su relación 'brand' y los pagina
        $cars = Car::with('brand')->paginate(10);
        return view('admin.cars.index', compact('cars'));
    }

    /**
     * Muestra el formulario para registrar un nuevo auto.
     */
    public function create()
    {
        // Se obtienen todas las marcas para asignar una al nuevo auto
        $brands = Brand::all();
        return view('admin.cars.create', compact('brands'));
    }

    /**
     * Guarda un nuevo auto en la base de datos.
     */
    public function store(Request $request)
    {
        // Valida los datos del formulario
        $validated = $request->validate([
            'model' => 'required|string|max:255',
            'brand_id' => 'required|exists:brands,id', // Debe existir la marca
            'price' => 'required|numeric|min:0',
            'kilometraje' => 'required|numeric|min:0',
        ]);

        // Crea el auto con los datos validados
        Car::create($validated);

        return redirect()->route('admin.cars.index')
                         ->with('success', 'Auto creado correctamente.');
    }

    /**
     * Muestra el formulario para editar los datos de un auto existente.
     */
    public function edit(Car $car)
    {
        // Se obtienen todas las marcas para permitir cambiar la asignación
        $brands = Brand::all();
        return view('admin.cars.edit', compact('car', 'brands'));
    }

    /**
     * Actualiza la información de un auto existente.
     */
    public function update(Request $request, Car $car)
    {
        // Valida los nuevos datos del auto
        $validated = $request->validate([
            'model' => 'required|string|max:255',
            'brand_id' => 'required|exists:brands,id',
            'price' => 'required|numeric|min:0',
            'kilometraje' => 'required|numeric|min:0',
        ]);

        // Aplica los cambios al auto
        $car->update($validated);

        return redirect()->route('admin.cars.index')
                         ->with('success', 'Auto actualizado correctamente.');
    }

    /**
     * Elimina un auto de la base de datos.
     */
    public function destroy(Car $car)
    {
        $car->delete();

        return redirect()->route('admin.cars.index')
                         ->with('success', 'Auto eliminado correctamente.');
    }
}
