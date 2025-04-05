@extends('layouts.app')

@section('content')
    <h1>Crear auto</h1>

    <form action="{{ route('admin.cars.store') }}" method="POST">
        @csrf

        <input type="text" name="model" placeholder="Modelo" required>
        <select name="brand_id" required>
            @foreach($brands as $brand)
                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
            @endforeach
        </select>
        <input type="number" name="price" placeholder="Precio" required>
        <input type="number" name="kilometraje" placeholder="Kilometraje" required>

        <button type="submit">Guardar</button>
    </form>
@endsection
