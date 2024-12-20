<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     *
     * @param Request $request The HTTP request containing any relevant query parameters (e.g., reset token).
     * @return View The view for resetting the user's password.
     */
    public function create(Request $request): View
    {
        // Render and return the 'auth.reset-password' view, passing the request for context.
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * Validates the input, attempts to reset the user's password, and responds accordingly.
     *
     * @param Request $request The HTTP request containing the new password data.
     * @return RedirectResponse Redirects to the login page with a status message or back to the form with errors.
     * @throws ValidationException If the validation rules fail.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the password reset request data.
        $request->validate([
            'token' => ['required'], // The password reset token is required.
            'email' => ['required', 'email'], // The user's email must be valid.
            'password' => ['required', 'confirmed', Rules\Password::defaults()], // Password must meet security rules.
        ]);

        // Attempt to reset the user's password using the provided credentials.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                // Update the user's password and regenerate the remember token.
                $user->forceFill([
                    'password' => Hash::make($request->password), // Hash the new password for security.
                    'remember_token' => Str::random(60), // Generate a new "remember me" token.
                ])->save();

                // Fire the PasswordReset event to notify listeners of the password change.
                event(new PasswordReset($user));
            }
        );

        // Check the result of the password reset attempt.
        return $status == Password::PASSWORD_RESET
            // Redirect to the login page with a success message if reset was successful.
            ? redirect()->route('login')->with('status', __($status))
            // Redirect back with errors and the email input if the reset failed.
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
    }
}
