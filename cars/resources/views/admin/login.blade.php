@extends('layouts.app')

@section('content')
    <div class="text-center mt-5">
        <h2>Acceso administrativo</h2>
        <p>Por favor ingresa la contraseña para acceder al panel de administración</p>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.login.attempt') }}">
            @csrf
            <input type="password" name="password" class="form-control w-25 mx-auto mb-3" placeholder="Contraseña" />
            <button type="submit" class="btn btn-primary">Entrar</button>
        </form>
    </div>
@endsection
