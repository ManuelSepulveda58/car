<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Brand;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Muestra la página principal de bienvenida.
     */
    public function home()
    {
        return view('pages.home'); 
    }

    /**
     * Muestra el catálogo de autos con filtros aplicables desde el formulario de búsqueda.
     */
    public function catalog(Request $request)
    {
        // Iniciar consulta con relación a la marca
        $query = Car::with('brand');

        // Filtro por modelo
        if ($request->filled('model')) {
            $query->where('model', 'like', '%' . $request->model . '%');
        }

        // Filtro por marca
        if ($request->filled('brand_id')) {
            $query->where('brand_id', $request->brand_id);
        }

        // Filtro por precio mínimo
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }

        // Filtro por precio máximo
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        // Filtro por kilometraje mínimo
        if ($request->filled('km_min')) {
            $query->where('kilometraje', '>=', $request->km_min);
        }

        // Filtro por kilometraje máximo
        if ($request->filled('km_max')) {
            $query->where('kilometraje', '<=', $request->km_max);
        }

        // Paginación de resultados
        $cars = $query->paginate(9)->withQueryString();

        // Obtener todas las marcas para el filtro desplegable
        $brands = Brand::orderBy('name')->get();

        // Retornar la vista con los autos y las marcas
        return view('index', compact('cars', 'brands'));
    }
}
