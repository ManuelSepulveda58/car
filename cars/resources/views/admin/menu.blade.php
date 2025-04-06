@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Panel de Administración</h2>
    <p>Selecciona qué deseas administrar:</p>

    <div class="d-flex gap-3">
        <a href="{{ route('admin.cars.index') }}" class="btn btn-outline-primary">Administrar Autos</a>
        <a href="{{ route('admin.brands.index') }}" class="btn btn-outline-secondary">Administrar Marcas</a>
    </div>
</div>
@endsection
