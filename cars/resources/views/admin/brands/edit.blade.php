@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar marca</h1>

    <!-- Formulario para actualizar la marca -->
    <form action="{{ route('admin.brands.update', $brand) }}" method="POST" enctype="multipart/form-data">
        @csrf <!-- Protección contra ataques CSRF -->
        @method('PUT') <!-- Indica que esta es una solicitud PUT -->

        <!-- Campo para editar el nombre de la marca -->
        <div class="mb-3">
            <label for="name" class="form-label">Nombre de la marca</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $brand->name }}" required>
        </div>

        <!-- Campo para cambiar o subir una nueva imagen de la marca -->
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen de la marca</label>
            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
        </div>

        <!-- Mostrar imagen actual de la marca si existe -->
        @if ($brand->imagen)
            <div class="mb-3">
                <img src="{{ asset('storage/' . $brand->imagen) }}" alt="Imagen actual" style="max-height: 100px;">
            </div>
        @endif

        <!-- Botón para enviar/actualizar y Cancelar -->
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('admin.brands.index') }}" class="btn btn-danger ms-2">Cancelar</a> 
    </form>
</div>
@endsection
