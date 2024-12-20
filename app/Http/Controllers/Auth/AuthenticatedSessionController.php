<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return View The login view for the authentication page.
     */
    public function create(): View
    {
        // Render and return the 'auth.login' view to the user.
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param LoginRequest $request The validated login request containing user credentials.
     * @return RedirectResponse Redirects the user to the intended location (or dashboard if not specified).
     * @throws ValidationException Thrown if the user's credentials are invalid.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authenticate the user using the credentials provided in the request.
        $request->authenticate();

        // Regenerate the session ID to prevent session fixation attacks.
        $request->session()->regenerate();

        // Redirect the user to the intended route or the dashboard if no intended route is set.
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     *
     * @param Request $request The HTTP request containing session and authentication data.
     * @return RedirectResponse Redirects the user to the application's home page after logout.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Log the user out of the 'web' guard (default authentication guard).
        Auth::guard('web')->logout();

        // Invalidate the user's session to clear all session data.
        $request->session()->invalidate();

        // Regenerate the CSRF token to ensure security after logout.
        $request->session()->regenerateToken();

        // Redirect the user to the home page.
        return redirect('/');
    }
}
