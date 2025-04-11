@extends('layouts.app')

@section('content')


<style>
/**
 * Este bloque define estilos personalizados para la página de bienvenida.
 */
    body {
        background: linear-gradient(to right,rgb(98, 171, 244),rgb(233, 241, 234));
    }

    .home-container {
        min-height: 80vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .home-container h1 {
        font-size: 3rem;
        color:rgb(0, 0, 0);
    }

    .home-container p {
        font-size: 1.2rem;
        color:rgb(4, 10, 55);
        margin-bottom: 2rem;
    }

    .home-container a.btn {
        padding: 0.75rem 2rem;
        font-size: 1.2rem;
        border-radius: 30px;
    }

    .home-image {
        margin-top: 3rem;
        max-width: 600px;
        width: 90%;
        border-radius: 10px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    }
</style>

<!--Contiene el contenido principal-->
<div class="container home-container">
    <h1>Bienvenido a <span class="text-primary">CarDealer</span></h1>   <!--Titulo-->
    <p>Explora nuestro catálogo de autos modernos</p>
    <a href="{{ route('index') }}" class="btn btn-primary btn-lg">Ver Catálogo</a> <!--Boton Catalogo-->
    <div class="text-center mt-5">
        <!--Imagen-->
        <img src="{{ asset('images/catalogo.jpg') }}" alt="Catálogo de autos" class="img-fluid rounded shadow" style="max-height: 400px;">
    </div>
</div>
@endsection
