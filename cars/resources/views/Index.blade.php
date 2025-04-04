@extends('layouts.app')

@section('content')
    <!-- Filtros -->
    <div class="filters">
        <input type="text" id="modelFilter" placeholder="Modelo (ej: Civic)">
        <input type="number" id="minPrice" placeholder="Precio mínimo">
        <input type="number" id="maxPrice" placeholder="Precio máximo">
        <button onclick="filterCars()">Buscar</button>
    </div>

    <!-- Resultados -->
    <div id="results">
        @foreach ($cars as $car)
            <div class="car-card">
                <h3>{{ $car->model }}</h3>
                <p><strong>Marca:</strong> {{ $car->brand->name }}</p>
                <p><strong>Precio:</strong> ${{ number_format($car->price, 2) }}</p>
                <p><strong>Kilometraje:</strong> {{ number_format($car->kilometraje) }} km</p>
            </div>
        @endforeach
    </div>

    <!-- JavaScript integrado -->
    <script>
        async function filterCars() {
            const model = document.getElementById('modelFilter').value;
            const minPrice = document.getElementById('minPrice').value;
            const maxPrice = document.getElementById('maxPrice').value;

            try {
                const response = await fetch(`/api/cars/filter?model=${model}&min_price=${minPrice}&max_price=${maxPrice}`);
                const { data } = await response.json();
                
                let html = '';
                data.forEach(car => {
                    html += `
                        <div class="car-card">
                            <h3>${car.model}</h3>
                            <p>Marca: ${car.brand.name}</p>
                            <p>Precio: $${car.price.toLocaleString()}</p>
                        </div>
                    `;
                });

                document.getElementById('results').innerHTML = html || '<p>No se encontraron autos.</p>';
            } catch (error) {
                console.error("Error:", error);
                document.getElementById('results').innerHTML = '<p class="error">Error al cargar datos.</p>';
            }
        }
    </script>
@endsection