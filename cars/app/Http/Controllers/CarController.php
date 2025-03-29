<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Http\Requests\CarRequest;
use Illuminate\Http\JsonResponse;

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



    /**
     * Store a newly created resource in storage.
     */
    public function store(CarRequest $request)
    {
        $car = Car::create($request->validated());
        return response()->json($car, 201);
    }
    
    

    /**
     * Display the specified resource.
     */
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
