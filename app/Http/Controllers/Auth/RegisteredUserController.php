<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return View The view for the user registration page.
     */
    public function create(): View
    {
        // Render and return the 'auth.register' view.
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * Validates the request, creates a new user, triggers a registration event,
     * logs the user in, and redirects them to the dashboard.
     *
     * @param Request $request The HTTP request containing user registration data.
     * @return RedirectResponse Redirects the user to the dashboard after successful registration.
     * @throws ValidationException If the validation fails.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the registration data.
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'], // First name is required and must not exceed 255 characters.
            'last_name' => ['required', 'string', 'max:255'], // Last name is required and must not exceed 255 characters.
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class], // Email must be unique, valid, and in lowercase.
            'password' => ['required', 'confirmed', Rules\Password::defaults()], // Password must meet the security rules and match confirmation.
        ]);

        // Create a new user in the database with the validated data.
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password for security.
        ]);

        // Trigger the Registered event to handle any post-registration logic.
        event(new Registered($user));

        // Log the user in immediately after registration.
        Auth::login($user);

        // Redirect the user to the dashboard.
        return redirect(route('dashboard', absolute: false));
    }
}
