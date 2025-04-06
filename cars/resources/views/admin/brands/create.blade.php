@extends('layouts.app')

@section('content')
    <h1>Agregar nueva marca</h1>

    <form action="{{ route('admin.brands.store') }}" method="POST">
        @csrf
        <label for="name">Nombre de la marca:</label>
        <input type="text" name="name" required>
        <button type="submit">Guardar</button>
    </form>

    <a href="{{ route('admin.brands.index') }}">← Volver al listado</a>
@endsection
