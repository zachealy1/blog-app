<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ConfirmablePasswordController extends Controller
{
    /**
     * Show the confirm password view.
     *
     * @return View The view where the user can confirm their password.
     */
    public function show(): View
    {
        // Render and return the 'auth.confirm-password' view.
        return view('auth.confirm-password');
    }

    /**
     * Confirm the user's password.
     *
     * @param Request $request The incoming HTTP request containing the user's password.
     * @return RedirectResponse Redirects to the intended route (or dashboard by default) upon successful confirmation.
     * @throws ValidationException If the provided password does not match the authenticated user's password.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the provided password against the authenticated user's credentials.
        if (!Auth::guard('web')->validate([
            'email' => $request->user()->email, // Fetch the authenticated user's email.
            'password' => $request->password,   // Compare with the provided password.
        ])) {
            // Throw a validation exception if the password is incorrect.
            throw ValidationException::withMessages([
                'password' => __('auth.password'), // Use a translatable message for error feedback.
            ]);
        }

        // Store the current timestamp to indicate when the password was last confirmed.
        $request->session()->put('auth.password_confirmed_at', time());

        // Redirect the user to their intended location, or the dashboard if no intended route is specified.
        return redirect()->intended(route('dashboard', absolute: false));
    }
}
