@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar marca</h1>

    <form action="{{ route('admin.brands.update', $brand) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nombre de la marca</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $brand->name }}" required>
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen de la marca</label>
            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
        </div>

        @if ($brand->imagen)
            <div class="mb-3">
                <img src="{{ asset('storage/' . $brand->imagen) }}" alt="Imagen actual" style="max-height: 100px;">
            </div>
        @endif

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
