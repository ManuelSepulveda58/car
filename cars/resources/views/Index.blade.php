@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center fw-bold display-5 text-primary">Catálogo de Autos</h1>

    <!-- Acordeon de filtros -->
    <div class="accordion mb-5" id="filtrosAccordion">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFiltros">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFiltros" aria-expanded="true" aria-controls="collapseFiltros">
                    <i class="bi bi-filter me-2"></i> Filtrar Catálogo
                </button>
            </h2>
            <!-- Contenido colapsable -->
            <div id="collapseFiltros" class="accordion-collapse collapse show" aria-labelledby="headingFiltros">
                <div class="accordion-body bg-light-subtle rounded">
                    <!-- Formulario de filtros -->
                    <form method="GET" action="{{ route('index') }}">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <label for="model" class="form-label">Modelo</label>
                                <input type="text" name="model" id="model" value="{{ request('model') }}" class="form-control" placeholder="Ej: Corolla, Fiesta">
                            </div>

                            <!-- Campo: Marca -->
                            <div class="col-md-4">
                                <label for="brand_id" class="form-label">Marca</label>
                                <select name="brand_id" id="brand_id" class="form-select">
                                    <option value="">Todas</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ request('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Campo: Precio mínimo -->
                            <div class="col-md-2">
                                <label for="price_min" class="form-label">Precio mínimo</label>
                                <input type="number" name="price_min" id="price_min" value="{{ request('price_min') }}" class="form-control" placeholder="Min" step="1000000" min="0" oninput="validarValor(this)">
                            </div>

                            <!-- Campo: Precio maximo -->
                            <div class="col-md-2">
                                <label for="price_max" class="form-label">Precio máximo</label>
                                <input type="number" name="price_max" id="price_max" value="{{ request('price_max') }}" class="form-control" placeholder="Max" step="1000000" min="0" oninput="validarValor(this)">
                            </div>

                            <!-- Campo: Kilometro mínimo -->
                            <div class="col-md-2">
                                <label for="km_min" class="form-label">KM mínimo</label>
                                <input type="number" name="km_min" id="km_min" value="{{ request('km_min') }}" class="form-control" placeholder="Min" step="1000" min="0" oninput="validarValor(this)">
                            </div>

                            <!-- Campo: Kilometro mínimo -->
                            <div class="col-md-2">
                                <label for="km_max" class="form-label">KM máximo</label>
                                <input type="number" name="km_max" id="km_max" value="{{ request('km_max') }}" class="form-control" placeholder="Max" step="1000" min="0" oninput="validarValor(this)">
                            </div>
                            
                            <!-- Botones: Buscar y Limpiar -->
                            <div class="col-md-8 d-flex align-items-end justify-content-end gap-2">
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-search"></i> Buscar🔍​
                                </button>
                                <a href="{{ route('index') }}" class="btn btn-outline-danger">
                                    <i class="bi bi-x-circle"></i> Limpiar filtros🧽​
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Resultados -->
    <div class="row">
        @forelse ($cars as $car)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow rounded-4 border-0">
                    @if ($car->brand->imagen)
                        <img src="{{ asset('storage/' . $car->brand->imagen) }}" alt="Logo {{ $car->brand->name }}" class="card-img-top p-3" style="max-height: 200px; object-fit: contain;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ $car->model }}</h5>
                        <p class="card-text"><strong>Marca:</strong> {{ $car->brand->name }}</p>
                        <p class="card-text"><strong>Precio:</strong> ${{ number_format($car->price, 0, ',', '.') }}</p>
                        <p class="card-text"><strong>Kilometraje:</strong> {{ number_format($car->kilometraje, 0, ',', '.') }} km</p>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">No se encontraron autos con los filtros seleccionados.</p>
        @endforelse
    </div>

    <!-- Paginación -->
    <div class="mt-5 d-flex justify-content-center">
        {{ $cars->links() }}
    </div>
</div>

<!-- JS para evitar valores negativos -->
<script>
    function validarValor(input) {
        if (parseInt(input.value) < 0) {
            input.value = 0;
        }
    }
</script>
@endsection
