<?php

namespace App\Http\Controllers;
use App\Models\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::orderBy('name')->paginate(5);
        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);
    
        $rutaImagen = null;
    
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('brands', 'public');
        }
    
        Brand::create([
            'name' => $request->name,
            'imagen' => $rutaImagen
        ]);
    
        return redirect()->route('admin.brands.index')->with('success', 'Marca creada correctamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);
    
        $datos = ['name' => $request->name];
    
        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe
            if ($brand->imagen && \Storage::disk('public')->exists($brand->imagen)) {
                \Storage::disk('public')->delete($brand->imagen);
            }
    
            $datos['imagen'] = $request->file('imagen')->store('brands', 'public');
        }
    
        $brand->update($datos);
    
        return redirect()->route('admin.brands.index')->with('success', 'Marca actualizada correctamente.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('admin.brands.index')->with('success', 'Marca eliminada correctamente.');
    }
}
