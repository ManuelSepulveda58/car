@extends('layouts.app')

@section('content')
    <h1>Lista de autos</h1>

    <!-- Botón para agregar nuevo auto -->
    <a href="{{ route('admin.cars.create') }}" class="btn btn-success mb-3">
        ➕ Agregar nuevo auto
    </a>

    <!-- Lista de autos -->
    @foreach ($cars as $car)
        <div>
            <strong>{{ $car->model }}</strong> - {{ $car->brand->name }} - ${{ $car->price }}
        </div>
    @endforeach

    <!-- Paginación -->
    {{ $cars->links() }}
@endsection
