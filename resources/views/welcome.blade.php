<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to My Laravel App</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="card shadow-lg p-4" style="max-width: 600px;">
        <div class="card-body text-center">
            <h1 class="card-title text-danger mb-4">CSF304 - Coursework 2</h1>
            <p class="card-text text-muted mb-4">Your platform to manage posts, notifications, and more.</p>

            @if (Route::has('login'))
                <div>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-lg">Go to Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-danger btn-lg">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-secondary btn-lg ms-2">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </div>
</div>

<footer class="text-center mt-4">
    <p class="text-muted">Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
