@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center fw-bold display-5 text">Gestión de Marcas</h1>

    <!-- Alerta de éxito -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <!-- Botón para agregar una nueva marca y Regresar-->
    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('admin.cars.index') }}" class="btn btn-secondary">Regresar a autos</a>      
        <a href="{{ route('admin.brands.create') }}" class="btn btn-primary">Agregar Marca</a>  
    </div>

    <!-- Tabla de marcas -->
    @if ($brands->count())
        <div class="table-responsive">
            <table class="table table-hover align-middle shadow-sm rounded-4 overflow-hidden">
                <thead class="table-primary text-center">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($brands as $brand)
                        <tr>
                            <!-- Número de fila -->
                            <td>{{ $loop->iteration }}</td>

                            <!-- Nombre de la marca -->
                            <td class="fw-semibold">{{ $brand->name }}</td>

                            <!-- Acciones de edición y eliminación -->
                            <td class="d-flex justify-content-center gap-2">
                                <a href="{{ route('admin.brands.edit', $brand) }}" class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-pencil-square"></i> Editar ❀
                                </a>

                                <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" onsubmit="return confirm('¿Estas Seguro En Eliminar esta marca ☠︎︎ ?')" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i> Eliminar ☠︎︎
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="mt-4 d-flex justify-content-center">
            {{ $brands->links() }}
        </div>
    @else
        <div class="alert alert-info text-center">No hay marcas registradas actualmente.</div>
    @endif
</div>
@endsection
