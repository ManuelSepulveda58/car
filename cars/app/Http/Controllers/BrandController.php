<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\JsonResponse;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():JsonResponse
    {
        $brand= Brand::paginate(10);
        return response()->json([
            'data'=>$brand,
            'status'=>200,
            'message'=>'Lista de marcas obtenida'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request):JsonResponse
    {
        $brand= Brand::create($request->all());
        return response()->json([
            'data'=>$brand,
            'status'=>201,
            'message'=>'Marca creada exitosamente'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id):JsonResponse
    {
        $brand= Brand::find($id);
        if(!$brand){
            return response()->json([
                'data'=>$brand,
                'status'=>404,
                'message'=>'Marca no encontrada'
            ]);
        }
        return response()->json([
            'data' => $brand,
            'status' => 200,
            'message' => 'Marca encontrada.'
        ]);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, string $id):JsonResponse
    {
        $brand = Brand::find($id);
        if(!$brand){
            return response()->json([
               'data'=>$brand,
               'status'=>404,
               'message'=>'Marca no encontrada' 
            ]);
        }
        $brand->update($request->all());

        return response()->json([
            'data' => $brand,
            'status' => 200,
            'message' => 'Marca actualizada correctamente.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id):JsonResponse
    {
        $brand = Brand::find($id);
        if(!$brand){
            return response()->json([
               'data'=>$brand,
               'status'=>404,
               'message'=>'Marca no encontrada' 
            ]);
        }
        $brand->delete();
        return response()->json([
            'data' => $brand,
            'status' => 200,
            'message' => 'Marca actualizada correctamente.'
        ]);
    }
}
