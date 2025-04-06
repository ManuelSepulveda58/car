@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-center">Catálogo de Autos</h1>

    <!-- Filtros -->
    <div class="card p-3 mb-4">
        <div class="row g-2">
            <div class="col-md-4">
                <input type="text" id="modelFilter" class="form-control" placeholder="Modelo (ej: Civic)">
            </div>
            <div class="col-md-3">
                <input type="number" id="minPrice" class="form-control" placeholder="Precio mínimo">
            </div>
            <div class="col-md-3">
                <input type="number" id="maxPrice" class="form-control" placeholder="Precio máximo">
            </div>
            <div class="col-md-2">
                <button onclick="filterCars()" class="btn btn-primary w-100">Buscar</button>
            </div>
        </div>
    </div>



    <!-- Resultados -->
    <div id="results" class="row">
    @foreach ($cars as $car)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                @if ($car->brand->imagen)
                 <img src="{{ asset('storage/' . $car->brand->imagen) }}"
                  alt="Logo {{ $car->brand->name }}"
                  style="max-height: 200px; max-width: 100%; object-fit: contain; display: block; margin: 0 auto;" />
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $car->model }}</h5>
                    <p class="card-text"><strong>Marca:</strong> {{ $car->brand->name }}</p>
                    <p class="card-text"><strong>Precio:</strong> ${{ number_format($car->price, 2) }}</p>
                    <p class="card-text"><strong>Kilometraje:</strong> {{ number_format($car->kilometraje) }} km</p>
                </div>
            </div>
        </div>
    @endforeach
</div>


    @if ($cars->isEmpty())
        <p class="text-center mt-4">No hay autos disponibles por el momento.</p>
    @endif
</div>

<!-- JavaScript para filtros -->
<script>
    async function filterCars() {
        const model = document.getElementById('modelFilter').value;
        const minPrice = document.getElementById('minPrice').value;
        const maxPrice = document.getElementById('maxPrice').value;

        try {
            const response = await fetch(`/api/cars/filter?model=${model}&min_price=${minPrice}&max_price=${maxPrice}`);
            const { data } = await response.json();

            let html = '';
            if (data.length) {
                data.forEach(car => {
                    html += `
                        <div class="col">
                            <div class="card h-100 shadow-sm">
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 180px;">
                                    <span class="text-muted">[Imagen del auto]</span>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">${car.model}</h5>
                                    <p class="card-text"><strong>Marca:</strong> ${car.brand.name}</p>
                                    <p class="card-text"><strong>Precio:</strong> $${Number(car.price).toLocaleString()}</p>
                                    <p class="card-text"><strong>Kilometraje:</strong> ${Number(car.kilometraje).toLocaleString()} km</p>
                                </div>
                            </div>
                        </div>
                    `;
                });
            } else {
                html = '<p class="text-center">No se encontraron autos.</p>';
            }

            document.getElementById('results').innerHTML = html;
        } catch (error) {
            console.error("Error:", error);
            document.getElementById('results').innerHTML = '<p class="text-danger">Error al cargar datos.</p>';
        }
    }
</script>
@endsection
