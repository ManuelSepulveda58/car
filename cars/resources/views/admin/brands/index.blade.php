@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Listado de Marcas</h1>
        <a href="{{ route('admin.brands.create') }}" class="btn btn-primary">
            Agregar nueva marca
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($brands->count())
        <ul class="list-group">
            @foreach ($brands as $brand)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ $brand->name }}</span>
                    <div>
                        <a href="{{ route('admin.brands.edit', $brand) }}" class="btn btn-sm btn-warning me-2">Editar</a>
                        <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta marca?')">Eliminar</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>

        <div class="mt-3">
            {{ $brands->links() }}
        </div>
    @else
        <p>No hay marcas registradas.</p>
    @endif
@endsection
