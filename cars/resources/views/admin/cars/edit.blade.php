@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Editar auto</h1>

    <!-- Formulario para actualizar la información del auto -->
    <form action="{{ route('admin.cars.update', $car->id) }}" method="POST" class="row g-3">
        @csrf <!-- Protección CSRF -->
        @method('PUT') <!-- Método PUT para actualizar -->

        <!-- Campo: Modelo del auto -->
        <div class="col-md-6">
            <label for="model" class="form-label">Modelo</label>
            <input type="text" id="model" name="model" class="form-control" value="{{ $car->model }}" required>
        </div>

        <!-- Campo: Marca del auto -->
        <div class="col-md-6">
            <label for="brand_id" class="form-label">Marca</label>
            <select id="brand_id" name="brand_id" class="form-select" required>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" 
                        @if($car->brand_id == $brand->id) selected @endif>
                        {{ $brand->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Campo: Precio del auto -->
        <div class="col-md-6">
            <label for="price" class="form-label">Precio</label>
            <input type="number" id="price" name="price" class="form-control" value="{{ $car->price }}" required>
        </div>

        <!-- Campo: Kilometraje del auto -->
        <div class="col-md-6">
            <label for="kilometraje" class="form-label">Kilometraje</label>
            <input type="number" id="kilometraje" name="kilometraje" class="form-control" value="{{ $car->kilometraje }}" required>
        </div>

        <!-- Botón para actualizar -->
        <div class="col-12 mt-3">
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('admin.cars.index') }}" class="btn btn-secondary ms-2">Cancelar</a>
        </div>
    </form>
</div>
@endsection
