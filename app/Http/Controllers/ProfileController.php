<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     *
     * @param Request $request The current HTTP request instance.
     * @return View The view displaying the profile edit form.
     */
    public function edit(Request $request): View
    {
        // Render the 'profile.edit' view, passing the authenticated user to the view.
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     *
     * Validates the input, updates the user's profile data, and handles email verification status if the email changes.
     *
     * @param ProfileUpdateRequest $request The HTTP request containing validated profile data.
     * @return RedirectResponse Redirects back to the profile edit page with a success status.
     */
    public function update(Request $request): RedirectResponse
    {
        // Validate input
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $request->user()->id,
        ]);

        // Update the authenticated user's data
        $user = $request->user();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->save();

        // Redirect back with success message
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     *
     * Validates the password, logs out the user, deletes their account, and invalidates the session.
     *
     * @param Request $request The HTTP request containing the user's password.
     * @return RedirectResponse Redirects to the home page after account deletion.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Validate the user's password for account deletion.
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'], // Ensure the current password matches.
        ]);

        // Retrieve the authenticated user.
        $user = $request->user();

        // Log the user out of the application.
        Auth::logout();

        // Delete the user's account from the database.
        $user->delete();

        // Invalidate the user's session and regenerate the CSRF token for security.
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to the home page after account deletion.
        return Redirect::to('/');
    }
}
