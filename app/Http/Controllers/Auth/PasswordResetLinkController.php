<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     *
     * @return View The view for requesting a password reset link.
     */
    public function create(): View
    {
        // Render and return the 'auth.forgot-password' view to allow the user to request a password reset link.
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * Validates the user's email and attempts to send a password reset link.
     * Provides feedback on the success or failure of the operation.
     *
     * @param Request $request The incoming HTTP request containing the user's email.
     * @return RedirectResponse Redirects back to the previous page with a status message or errors.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the email field to ensure it is required and formatted as a valid email address.
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // Attempt to send the password reset link to the provided email address.
        $status = Password::sendResetLink(
            $request->only('email') // Extract only the email from the request data.
        );

        // Check the response status of the reset link attempt.
        return $status == Password::RESET_LINK_SENT
            // If successful, redirect back with a status message indicating the link was sent.
            ? back()->with('status', __($status))
            // If unsuccessful, redirect back with the input email and error messages.
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
    }
}
