@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Listado de Marcas</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('admin.brands.create') }}" class="btn btn-success">Agregar nueva marca</a>
    </div>

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
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $brand->name }}</td>
                        <td class="d-flex gap-1">
                            <a href="{{ route('admin.brands.edit', $brand) }}" class="btn btn-primary btn-sm">Editar</a>
                            <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" onsubmit="return confirm('¿Eliminar esta marca?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Paginación --}}
        {{ $brands->links() }}
    @else
        <div class="alert alert-info">No hay marcas registradas.</div>
    @endif
</div>
@endsection
