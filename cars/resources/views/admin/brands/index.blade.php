@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Listado de Marcas</h1>

    <!-- Mostrar mensaje de éxito si existe en la sesión -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Botón para crear una nueva marca -->
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('admin.brands.create') }}" class="btn btn-success">Agregar nueva marca</a>
    </div>

    <!-- Validar si hay marcas para mostrar -->
    @if ($brands->count())
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($brands as $brand)
                    <tr>
                        <!-- Iteración numérica -->
                        <td>{{ $loop->iteration }}</td>

                        <!-- Nombre de la marca -->
                        <td>{{ $brand->name }}</td>

                        <!-- Acciones disponibles: Editar y Eliminar -->
                        <td class="d-flex gap-1">
                            <!-- Botón para editar la marca -->
                            <a href="{{ route('admin.brands.edit', $brand) }}" class="btn btn-primary btn-sm">Editar✏️</a>

                            <!-- Formulario para eliminar la marca -->
                            <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" onsubmit="return confirm('¿Eliminar esta marca?')">
                                @csrf <!-- Protección CSRF -->
                                @method('DELETE') <!-- Método DELETE para eliminar -->
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar⚠️</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Controles de paginación -->
        {{ $brands->links() }}
    @else
        <!-- Mensaje si no hay marcas registradas -->
        <div class="alert alert-info">No hay marcas registradas.</div>
    @endif
</div>
@endsection
