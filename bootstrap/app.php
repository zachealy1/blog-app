<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__)) // Set the base path for the application.
->withRouting(
    web: __DIR__ . '/../routes/web.php',          // Load web routes from the specified file.
    commands: __DIR__ . '/../routes/console.php', // Load console routes (artisan commands) from the specified file.
    health: '/up',                              // Set the health check endpoint to `/up`.
)
    ->withMiddleware(function (Middleware $middleware) {
        // Register global middleware here.
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Configure exception handling here.
    })->create(); // Create and return the configured application instance.
