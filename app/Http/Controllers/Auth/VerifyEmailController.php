<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * This controller uses the single-action `__invoke` method.
     * It verifies the user's email if it hasn't already been verified
     * and triggers the appropriate events for email verification.
     *
     * @param EmailVerificationRequest $request The incoming request containing the authenticated user.
     * @return RedirectResponse Redirects the user to the dashboard with a `verified` query parameter.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        // Check if the user's email is already verified.
        if ($request->user()->hasVerifiedEmail()) {
            // Redirect to the dashboard with a 'verified' query parameter indicating success.
            return redirect()->intended(route('dashboard', absolute: false) . '?verified=1');
        }

        // Mark the user's email as verified and trigger the Verified event if successful.
        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        // Redirect to the dashboard with a 'verified' query parameter indicating success.
        return redirect()->intended(route('dashboard', absolute: false) . '?verified=1');
    }
}
