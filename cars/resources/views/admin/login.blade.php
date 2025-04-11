@extends('layouts.app')

@section('content')
<style>
    .admin-login-container {
        min-height: 80vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(135deg, #e3f2fd, #fce4ec);
    }

    .admin-login-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 2.5rem;
        max-width: 500px;
        width: 100%;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .admin-login-card h2 {
        color: #2c3e50;
        margin-bottom: 1rem;
    }

    .admin-login-card p {
        color: #555;
        margin-bottom: 1.5rem;
    }

    .admin-login-card input[type="password"] {
        border-radius: 10px;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        border: 1px solid #ccc;
    }

    .admin-login-card button {
        border-radius: 30px;
        padding: 0.6rem 2rem;
        font-size: 1rem;
        background-color: #007bff;
        color: white;
        border: none;
        transition: background-color 0.3s ease;
    }

    .admin-login-card button:hover {
        background-color: #0056b3;
    }
</style>

<div class="admin-login-container">
    <div class="admin-login-card">
        <h2>Acceso Administrativo</h2>
        <p>Por favor ingresa la contraseña para acceder al panel de administración "1234"</p>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.login.attempt') }}">
            @csrf
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Contraseña" required />
            </div>
            <button type="submit">Entrar</button>
        </form>
    </div>
</div>
@endsection
