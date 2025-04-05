@extends('layouts.app')

@section('content')
    <h1>Lista de autos</h1>

    @foreach ($cars as $car)
        <div>
            <strong>{{ $car->model }}</strong> - {{ $car->brand->name }} - ${{ $car->price }}
        </div>
    @endforeach

    {{ $cars->links() }}
@endsection
