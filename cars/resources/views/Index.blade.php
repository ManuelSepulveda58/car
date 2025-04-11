@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h1 class="mb-4 text-center">Catálogo de Autos</h1>

    <!-- Formulario de filtros -->
    <form method="GET" action="{{ route('index') }}" class="card p-4 mb-4 shadow-sm">
        <div class="row g-3">
            <!-- Modelo -->
            <div class="col-md-3">
                <input type="text" name="model" class="form-control" placeholder="Modelo (ej: Civic)"
                    value="{{ request('model') }}">
            </div>

            <!-- Marca -->
            <div class="col-md-3">
                <select name="brand_id" class="form-select">
                    <option value="">-- Marca --</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}" {{ request('brand_id') == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Precio mínimo -->
            <div class="col-md-2">
                <input type="number" name="price_min" class="form-control" placeholder="Precio mínimo"
                    value="{{ request('price_min') }}">
            </div>

            <!-- Precio máximo -->
            <div class="col-md-2">
                <input type="number" name="price_max" class="form-control" placeholder="Precio máximo"
                    value="{{ request('price_max') }}">
            </div>

            <!-- Botón de búsqueda -->
            <div class="col-md-2 d-grid">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>

            <!-- Kilometraje mínimo -->
            <div class="col-md-3">
                <input type="number" name="km_min" class="form-control" placeholder="Kilometraje mínimo"
                    value="{{ request('km_min') }}">
            </div>

            <!-- Kilometraje máximo -->
            <div class="col-md-3">
                <input type="number" name="km_max" class="form-control" placeholder="Kilometraje máximo"
                    value="{{ request('km_max') }}">
            </div>
        </div>
    </form>

    <!-- Resultados de autos -->
    <div class="row">
        @forelse ($cars as $car)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    @if ($car->brand->imagen)
                        <img src="{{ asset('storage/' . $car->brand->imagen) }}"
                             alt="Logo {{ $car->brand->name }}"
                             class="card-img-top"
                             style="max-height: 200px; object-fit: contain;" />
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $car->model }}</h5>
                        <p class="card-text"><strong>Marca:</strong> {{ $car->brand->name }}</p>
                        <p class="card-text"><strong>Precio:</strong> ${{ number_format($car->price, 2) }}</p>
                        <p class="card-text"><strong>Kilometraje:</strong> {{ number_format($car->kilometraje) }} km</p>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center mt-4">No se encontraron autos con los filtros seleccionados.</p>
        @endforelse
    </div>

    <!-- Paginación -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $cars->links() }}
    </div>
</div>
@endsection
