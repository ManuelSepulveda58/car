@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Listado de Autos</h1>

    <!-- Mensaje de éxito si se realizó alguna acción crear/actualizar/eliminar -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Botones para ir a la sección de marcas o agregar un nuevo auto -->
    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">Administrar Marcas</a>
        <a href="{{ route('admin.cars.create') }}" class="btn btn-success">Agregar nuevo auto</a>
    </div>

    <!-- Verificamos si hay autos registrados -->
    @if ($cars->count())
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Modelo</th>
                    <th>Marca</th>
                    <th>Precio</th>
                    <th>Kilometraje</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Recorremos los autos disponibles -->
                @foreach ($cars as $car)
                    <tr>
                        <!-- Número del auto  -->
                        <td>{{ $loop->iteration }}</td>

                        <!-- Modelo del auto -->
                        <td>{{ $car->model }}</td>

                        <!-- Nombre de la marca asociada -->
                        <td>{{ $car->brand->name }}</td>

                        <!-- Precio formateado -->
                        <td>${{ number_format($car->price, 2) }}</td>

                        <!-- Kilometraje formateado con "km" -->
                        <td>{{ number_format($car->kilometraje) }} km</td>

                        <!-- Botones de acción: Editar y Eliminar -->
                        <td>
                            <!-- Editar auto -->
                            <a href="{{ route('admin.cars.edit', $car) }}" class="btn btn-primary btn-sm">Editar✏️</a>

                            <!-- Eliminar auto -->
                            <form action="{{ route('admin.cars.destroy', $car) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Eliminar este auto?')">
                                    Eliminar⚠️
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
