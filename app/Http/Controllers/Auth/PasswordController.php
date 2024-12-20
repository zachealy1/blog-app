<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     *
     * Validates the user's current and new password, updates the password in the database,
     * and provides feedback on the operation's success.
     *
     * @param Request $request The HTTP request containing the user's password update data.
     * @return RedirectResponse Redirects back with a status message upon successful password update.
     */
    public function update(Request $request): RedirectResponse
    {
        // Validate the incoming request data, assigning errors to the 'updatePassword' error bag.
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'], // Ensure the current password is correct.
            'password' => ['required', Password::defaults(), 'confirmed'], // Ensure the new password is secure and matches the confirmation.
        ]);

        // Update the user's password in the database, hashing the new password for security.
        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        // Redirect back to the previous page with a success status message.
        return back()->with('status', 'password-updated');
    }
}
