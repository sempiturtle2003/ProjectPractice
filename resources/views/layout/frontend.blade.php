<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My App</title>

    <!-- Bootstrap 5 CDN (you can use local files instead) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    {{-- top nav placeholder --}}
    <div class="container-fluid bg-light py-2">
        <div class="container">
            <a href="{{ url('/') }}" class="text-decoration-none">Home</a>
        </div>
    </div>

    <main class="py-4">
        @yield('content')
    </main>

    <!-- Bootstrap JS (for collapse toggler) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
