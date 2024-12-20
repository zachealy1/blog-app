<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /**
     * Delete the specified user from the database.
     *
     * Ensures that an admin cannot delete their own account and removes the specified user.
     *
     * @param User $user The user to be deleted.
     * @return RedirectResponse Redirects back with an error if self-deletion is attempted or a success message on deletion.
     */
    public function destroy(User $user): RedirectResponse
    {
        // Check if the authenticated admin is trying to delete their own account.
        if (auth()->id() === $user->id) {
            // Redirect back with an error message.
            return redirect()
                ->back()
                ->with('error', 'You cannot delete your own account. Please contact another admin for assistance.');
        }

        // Delete the specified user.
        $user->delete();

        // Redirect to the admin dashboard with a success message.
        return redirect()
            ->route('admin.dashboard')
            ->with('success', "The user '{$user->name}' has been successfully deleted.");
    }


    /**
     * Display the specified user's profile.
     *
     * Eager loads the user's posts and comments for the profile view.
     *
     * @param User $user The user whose profile is being viewed.
     * @return View|Factory|Application The view displaying the user's profile along with their posts and comments.
     */
    public function show(User $user): View|Factory|Application
    {
        // Eager load the user's posts and comments in descending order of creation.
        $posts = $user->posts()->latest()->get();
        $comments = $user->comments()->latest()->get();

        // Render the 'users.show' view, passing the user, posts, and comments.
        return view('users.show', compact('user', 'posts', 'comments'));
    }
}
