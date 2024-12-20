<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * This middleware checks if the authenticated user is an admin.
     * If they are, it allows the request to proceed; otherwise, it redirects them to the home page.
     *
     * @param Request $request The incoming HTTP request.
     * @param Closure $next The next middleware or request handler.
     * @return mixed The next middleware or a redirect response for non-admin users.
     */
    public function handle(Request $request, Closure $next): mixed
    {
        // Check if the user is authenticated and has an admin role.
        if (Auth::check() && Auth::user()->isAdmin()) {
            // Allow the request to proceed further in the middleware stack.
            return $next($request);
        }

        // Redirect non-admin users to the home page or another page.
        return redirect('/');
    }
}
