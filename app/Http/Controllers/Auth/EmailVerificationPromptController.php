<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     *
     * This controller uses the single-action `__invoke` method.
     * It checks if the user's email is verified and either redirects them to the dashboard
     * or shows the email verification prompt.
     *
     * @param Request $request The incoming HTTP request containing the authenticated user.
     * @return RedirectResponse|View Redirects to the dashboard if email is verified, or returns the verification view.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        // Check if the authenticated user has already verified their email.
        return $request->user()->hasVerifiedEmail()
            // Redirect the user to the dashboard if their email is verified.
            ? redirect()->intended(route('dashboard', absolute: false))
            // Otherwise, display the 'auth.verify-email' view to prompt verification.
            : view('auth.verify-email');
    }
}
