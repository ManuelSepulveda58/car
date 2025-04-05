@extends('layouts.app')

@section('content')
    <h1>Editar auto</h1>

    <form action="{{ route('admin.cars.update', $car->id) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="text" name="model" value="{{ $car->model }}" required>
        <select name="brand_id" required>
            @foreach($brands as $brand)
                <option value="{{ $brand->id }}" @if($car->brand_id == $brand->id) selected @endif>
                    {{ $brand->name }}
                </option>
            @endforeach
        </select>
        <input type="number" name="price" value="{{ $car->price }}" required>
        <input type="number" name="kilometraje" value="{{ $car->kilometraje }}" required>

        <button type="submit">Actualizar</button>
    </form>
@endsection
