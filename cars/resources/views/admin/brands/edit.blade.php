@extends('layouts.app')

@section('content')
    <h1>Editar marca</h1>

    <form action="{{ route('admin.brands.update', $brand) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Nombre de la marca:</label>
        <input type="text" name="name" value="{{ $brand->name }}" required>
        <button type="submit">Actualizar</button>
    </form>

    <a href="{{ route('admin.brands.index') }}">← Volver al listado</a>
@endsection
