<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    /**
     * Show the form for creating a new user.
     *
     * @return View|Factory|Application The view for creating a new user.
     */
    public function create(): View|Factory|Application
    {
        // Render the 'admin.users.create' view for the new user form.
        return view('admin.users.create');
    }

    /**
     * Store a newly created user in the database.
     *
     * Validates the input, creates a user record, and redirects to the admin dashboard.
     *
     * @param Request $request The HTTP request containing new user details.
     * @return RedirectResponse Redirects to the admin dashboard with a success message.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the user input.
        $request->validate([
            'first_name' => 'required|string|max:255', // Ensure the first name is provided and valid.
            'last_name' => 'required|string|max:255',  // Ensure the last name is provided and valid.
            'email' => 'required|email|unique:users,email', // Email must be unique in the users table.
            'password' => 'required|string|min:8|confirmed', // Password must meet security requirements and match confirmation.
            'admin' => 'nullable|boolean', // Admin status is optional; defaults to false.
        ]);

        // Create a new user record in the database.
        User::create([
            'first_name' => $request->input('first_name'), // First name from the form input.
            'last_name' => $request->input('last_name'),   // Last name from the form input.
            'email' => $request->input('email'),          // Email address from the form input.
            'password' => Hash::make($request->input('password')), // Hash the password for security.
            'admin' => $request->input('admin', false),   // Admin status, defaults to false if not provided.
        ]);

        // Redirect to the admin dashboard with a success message.
        return redirect()->route('admin.dashboard')->with('success');
    }

    /**
     * Show the form for editing an existing user.
     *
     * @param User $user The user to be edited.
     * @return View|Factory|Application The view for editing the user.
     */
    public function edit(User $user): View|Factory|Application
    {
        // Render the 'admin.users.edit' view, passing the user data.
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user in the database.
     *
     * Validates the input, updates the user's details, and redirects to the admin dashboard.
     *
     * @param Request $request The HTTP request containing updated user details.
     * @param User $user The user being updated.
     * @return RedirectResponse Redirects to the admin dashboard with a success message.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        // Validate the user input.
        $request->validate([
            'first_name' => 'required|string|max:255', // Ensure the first name is provided and valid.
            'last_name' => 'required|string|max:255',  // Ensure the last name is provided and valid.
            'email' => 'required|email|max:255|unique:users,email,' . $user->id, // Email must be unique except for the current user.
            'password' => 'nullable|string|min:8|confirmed', // Password is optional but must meet security requirements if provided.
        ]);

        // Update the user's details with the validated input.
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');

        // If a new password is provided, hash and update it.
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // Update the user's admin status explicitly (defaults to 0 if not provided).
        $user->admin = $request->input('admin', false);

        // Save the updated user record to the database.
        $user->save();

        // Redirect to the admin dashboard with a success message.
        return redirect()->route('admin.dashboard')->with('success', "The user '{$user->name}' has been successfully updated.");
    }
}
