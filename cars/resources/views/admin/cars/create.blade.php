@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Registrar nuevo automóvil</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
        @csrf

        <div class="col-md-6">
            <label for="model" class="form-label">Modelo</label>
            <input type="text" class="form-control" id="model" name="model" required>
        </div>

        <div class="col-md-6">
            <label for="price" class="form-label">Precio</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>

        <div class="col-md-6">
            <label for="kilometraje" class="form-label">Kilometraje</label>
            <input type="number" class="form-control" id="kilometraje" name="kilometraje" required>
        </div>

        <div class="col-md-6">
            <label for="brand_id" class="form-label">Marca</label>
            <select name="brand_id" id="brand_id" class="form-select" required>
                <option value="">Selecciona una marca</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Si en el futuro deseas agregar imagen de auto --}}
        {{-- 
        <div class="col-md-12">
            <label for="image" class="form-label">Imagen del auto</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        --}}

        <div class="col-12">
            <button type="submit" class="btn btn-success">Guardar auto</button>
            <a href="{{ route('admin.cars.index') }}" class="btn btn-secondary ms-2">Cancelar</a>
        </div>
    </form>
</div>
@endsection
