<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Http\Requests\CarRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():JsonResponse
    {
        $car = Car::paginate(10);// obtener autos con paginacion de 10
        return response()->json([
            'data'=>$car,
            'status'=>200,
            'message'=>'Lista de autos  obtenida correctamente.'
        ]);
    }





    public function filter(Request $request)
    {
        // Inicia la consulta cargando la relación 'brand' y aplicando filtros
        $query = Car::with('brand');
    
        // 1. Filtro por modelo (búsqueda insensible a mayúsculas)
        if ($request->filled('model')) {
            $query->where('model', 'LIKE', '%' . $request->model . '%');
        }
    
        // 2. Filtro por rango de precio
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }
    
        // 3. Filtro por kilometraje máximo
        if ($request->filled('max_kilometraje')) {
            $query->where('kilometraje', '<=', $request->max_kilometraje);
        }
    
        // 4. Paginación (opcional, usa el valor por defecto si no se envía)
        $perPage = $request->input('per_page', 10);
        $cars = $query->paginate($perPage);
    
        // Estructura de respuesta estándar
        return response()->json([
            'data' => $cars->items(),
            'pagination' => [
                'total' => $cars->total(),
                'per_page' => $cars->perPage(),
                'current_page' => $cars->currentPage(),
            ],
            'status' => 200,
            'message' => 'Filtrado aplicado correctamente'
        ]);
    }


    public function store(CarRequest $request)
    {
        $car = Car::create($request->validated());
        return response()->json($car, 201);
    }
    
    

    public function show(string $id):JsonResponse
    {
        $car= Car::find($id);
        if (!$car) {
            return response()->json([
                'data'=>$car,
                'status'=> 404,
                'message'=>'Auto no encontrado.'
            ],404);
        }
        return response()->json([
            'data' => $car,
            'status' => 200,
            'message' => 'Auto encontrado.'
        ]);

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(CarRequest $request, string $id):JsonResponse
    {
        $car = Car::find($id);

        if (!$car) {
            return response()->json([
                'data' => null,
                'status' => 404,
                'message' => 'Auto no encontrado.'
            ]);
        }

        $car->update($request->all());

        return response()->json([
            'data' => $car,
            'status' => 200,
            'message' => 'Auto actualizado correctamente.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id):JsonResponse
    {
        $car = Car::find($id);

        if (!$car) {
            return response()->json([
                'data' => null,
                'status' => 404,
                'message' => 'Auto no encontrado.'
            ]);
        }

        $car->delete();

        return response()->json([
            'data' => null,
            'status' => 200,
            'message' => 'Auto eliminado correctamente.'
        ]);
    }
}
