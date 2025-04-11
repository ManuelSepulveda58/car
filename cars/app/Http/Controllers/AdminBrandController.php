<?php

namespace App\Http\Controllers;
use App\Models\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminBrandController extends Controller
{
    /**
     *  Muestra un listado paginado de marcas.
     */
    public function index()
    {
        $brands = Brand::orderBy('name')->paginate(5);
        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Muestra el formulario para crear una nueva marca.
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Guarda una nueva marca en la base de datos.
     */
    public function store(Request $request)
    {
        // Validación de los campos recibidos
        $request->validate([
            'name' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);
    
        $rutaImagen = null;

        // Si se subió una imagen, se almacena en el sistema de archivos
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('brands', 'public');
        }

        // Se crea la marca con el nombre y la ruta de imagen
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
     * Muestra el formulario para editar una marca existente.
     */
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Actualiza la información de una marca en la base de datos.
     */
    public function update(Request $request, Brand $brand)
    {
        // Validación de los campos actualizados
        $request->validate([
            'name' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);
    
        $datos = ['name' => $request->name];

        // Si se sube una nueva imagen, se reemplaza la anterior
        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe
            if ($brand->imagen && \Storage::disk('public')->exists($brand->imagen)) {
                \Storage::disk('public')->delete($brand->imagen);
            }
    
            $datos['imagen'] = $request->file('imagen')->store('brands', 'public');
        }

        // Actualiza la marca con los nuevos datos
        $brand->update($datos);
    
        return redirect()->route('admin.brands.index')->with('success', 'Marca actualizada correctamente.');
    }
    

    /**
     * Elimina una marca de la base de datos.
     */
    public function destroy(Brand $brand)
    {
        // Elimina la marca de la base de datos
        $brand->delete();
        return redirect()->route('admin.brands.index')->with('success', 'Marca eliminada correctamente.');
    }
}
