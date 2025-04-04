<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>CarDealer</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <nav>
        <a href="{{ route('home') }}">Inicio</a>
        <a href="{{ route('index') }}">Autos</a>
    </nav>
    
    <main>
        @yield('content')
    </main>
</body>
</html>