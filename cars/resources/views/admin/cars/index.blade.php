@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Listado de Autos</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('admin.cars.create') }}" class="btn btn-success">Agregar nuevo auto</a>
    </div>

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
                @foreach ($cars as $car)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $car->model }}</td>
                        <td>{{ $car->brand->name }}</td>
                        <td>${{ number_format($car->price, 2) }}</td>
                        <td>{{ number_format($car->kilometraje) }} km</td>
                        <td>
                            <a href="{{ route('admin.cars.edit', $car) }}" class="btn btn-primary btn-sm">Editar</a>
                            <form action="{{ route('admin.cars.destroy', $car) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Eliminar este auto?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $cars->links() }}
    @else
        <div class="alert alert-info">No hay autos registrados.</div>
    @endif
</div>
@endsection
