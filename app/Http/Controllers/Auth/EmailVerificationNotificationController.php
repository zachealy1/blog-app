<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     *
     * @param Request $request The incoming HTTP request containing the authenticated user.
     * @return RedirectResponse Redirects to the intended location or back to the previous page with a status message.
     */
    public function store(Request $request): RedirectResponse
    {
        // Check if the authenticated user's email is already verified.
        if ($request->user()->hasVerifiedEmail()) {
            // Redirect the user to the dashboard if the email is already verified.
            return redirect()->intended(route('dashboard', absolute: false));
        }

        // Send a new email verification notification to the authenticated user.
        $request->user()->sendEmailVerificationNotification();

        // Redirect back to the previous page with a status message indicating the verification link was sent.
        return back()->with('status', 'verification-link-sent');
    }
}
