@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agregar nueva marca</h1>

    <!-- Formulario para crear una marca -->
    <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
        @csrf <!-- Protección contra ataques CSRF -->

        <!-- Campo para el nombre de la marca -->
        <div class="mb-3">
            <label for="name" class="form-label">Nombre de la marca</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <!-- Campo para subir una imagen representativa de la marca -->
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen de la marca</label>
            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
        </div>

        <!-- Botón para guardar la marca -->
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
