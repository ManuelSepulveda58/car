@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Listado de Autos</h1>

    <!-- Mensaje de éxito si se realizó alguna acción crear/actualizar/eliminar -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Botones para ir a la sección de marcas o agregar un nuevo auto o Salir -->
    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">Administrar Marcas</a>
        <a href="{{ route('admin.cars.create') }}" class="btn btn-success">Agregar nuevo auto</a>
        <a href="{{ route('home') }}" class="btn btn-secondary">Salir de administración</a>
    </div>

    <!-- Verificamos si hay autos registrados -->
    @if ($cars->count())
    <table class="table table-striped table-hover align-middle shadow-sm rounded">
    <thead class="table-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Modelo</th>
            <th scope="col">Marca</th>
            <th scope="col">Precio</th>
            <th scope="col">Kilometraje</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cars as $car)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $car->model }}</td>
                <td>{{ $car->brand->name }}</td>
                <td>${{ number_format($car->price, 2) }}</td>
                <td>{{ number_format($car->kilometraje) }} km</td>
                <td>
                    <a href="{{ route('admin.cars.edit', $car) }}" class="btn btn-sm btn-outline-primary me-1">
                        ✏️ Editar
                    </a>
                    <form action="{{ route('admin.cars.destroy', $car) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('¿Seguro Que Quieres SEliminar este auto?')">
                            ⚠️ Eliminar
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

        <!-- Paginación -->
        {{ $cars->links() }}
    @else
        <!-- Si no hay autos, se muestra un mensaje informativo -->
        <div class="alert alert-info">No hay autos registrados.</div>
    @endif
</div>
@endsection
