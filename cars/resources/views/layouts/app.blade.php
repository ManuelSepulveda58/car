<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>CarDealer</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
 <style>
    body {
        background: linear-gradient(135deg,rgb(149, 199, 240),rgb(183, 196, 215));
        background-attachment: fixed;
        background-repeat: no-repeat;
        background-size: cover;
    }
 </style>

<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom px-4 py-2">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">CarDealer</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('index') }}">Catalogo</a>
                </li>
                <li class="nav-item">
                   <a class="nav-link" href="{{ route('admin.login') }}">Administración</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="container py-4">
    @yield('content')
</main>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
