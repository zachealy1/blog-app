<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Notifications\CommentNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a newly created comment in storage.
     *
     * Validates the input, creates a new comment, associates it with the authenticated user and post,
     * and notifies the post owner if applicable.
     *
     * @param Request $request The HTTP request containing the comment data.
     * @param Post $post The post to which the comment belongs.
     * @return RedirectResponse Redirects back to the post page with a success message.
     */
    public function store(Request $request, Post $post): RedirectResponse
    {
        // Validate the incoming comment data.
        $validated = $request->validate([
            'body' => 'required|string|max:1000', // Comment body is required and must not exceed 1000 characters.
        ]);

        // Create a new comment instance and populate it with validated data.
        $comment = new Comment();
        $comment->body = $validated['body'];
        $comment->user_id = auth()->id(); // Assign the authenticated user's ID as the commenter.
        $comment->post_id = $post->id;    // Associate the comment with the given post.
        $comment->save();                // Save the comment to the database.

        // Notify the post owner about the new comment, unless the commenter is the owner.
        if ($post->user->id !== auth()->id()) {
            $post->user->notify(new CommentNotification($comment));
        }

        // Redirect back to the post's detail page with a success message.
        return redirect()->route('posts.show', $post)->with('success', 'Comment added successfully');
    }
}
