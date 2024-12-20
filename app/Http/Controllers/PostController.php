<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of posts.
     *
     * @return View|Factory|Application The view displaying all posts.
     */
    public function index(): View|Factory|Application
    {
        // Retrieve all posts with their associated user.
        $posts = Post::with('user')->get();

        // Render the posts.index view with the retrieved posts.
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\Contracts\View\View The view for the create post form.
     */
    public function create(): \Illuminate\Contracts\View\View
    {
        // Render the posts.create view for post creation.
        return view('posts.create');
    }

    /**
     * Store a newly created post in the database.
     *
     * @param Request $request The HTTP request containing the new post data.
     * @return RedirectResponse Redirects to the newly created post with a success message.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the post data.
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate optional image upload.
        ]);

        // Handle file upload, if present.
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public'); // Save in the 'public/images' directory.
            $validated['image'] = $path; // Add the image path to the validated data.
        }

        // Save the post with the authenticated user as the owner.
        $post = auth()->user()->posts()->create($validated);

        // Redirect to the post's detail page with a success message.
        return redirect()->route('posts.show', $post)->with('success');
    }

    /**
     * Log a view for the given post.
     *
     * @param Post $post The post being viewed.
     */
    private function logView(Post $post): void
    {
        $user = auth()->user();
        $sessionKey = 'viewed_posts_' . $post->id;

        // Check if the post has already been viewed in this session.
        if (!session()->has($sessionKey)) {
            // Create a new view record for the post.
            View::create([
                'post_id' => $post->id,
                'user_id' => $user ? $user->id : null, // Associate the view with the user, if logged in.
            ]);

            // Mark the post as viewed in the session.
            session()->put($sessionKey, true);
        }
    }

    /**
     * Display the specified post.
     *
     * @param Post $post The post to display.
     * @return \Illuminate\Contracts\View\View|Factory|Application The view displaying the post.
     */
    public function show(Post $post): \Illuminate\Contracts\View\View|Factory|Application
    {
        // Log the view for the post.
        $this->logView($post);

        // Render the posts.show view with the post data.
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified post.
     *
     * @param Post $post The post to edit.
     * @return \Illuminate\Contracts\View\View The view for the edit post form.
     */
    public function edit(Post $post): \Illuminate\Contracts\View\View
    {
        // Authorise the action to ensure only the post owner can edit.
        $this->authorize('update', $post);

        // Render the posts.edit view with the post data.
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified post in the database.
     *
     * @param Request $request The HTTP request containing updated post data.
     * @param Post $post The post to update.
     * @return RedirectResponse Redirects to the post with a success message.
     */
    public function update(Request $request, Post $post): RedirectResponse
    {
        $this->authorize('update', $post);

        // Validate input data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update post title and content
        $post->title = $validated['title'];
        $post->content = $validated['content'];

        // Handle photo removal if 'remove_photo' checkbox is checked
        if ($request->has('remove_photo') && $post->image) {
            \Storage::disk('public')->delete($post->image); // Delete the photo from storage
            $post->image = null; // Clear the photo path in the database
        }

        // Handle new photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if it exists
            if ($post->image) {
                \Storage::disk('public')->delete($post->image);
            }

            $path = $request->file('photo')->store('photos', 'public'); // Store new photo
            $post->image = $path; // Update photo path in the database
        }

        // Save the updated post
        $post->save();

        return redirect()->route('posts.show', $post)->with('success', 'Post updated successfully');
    }


    /**
     * Remove the specified post from the database.
     *
     * @param Post $post The post to delete.
     * @return RedirectResponse Redirects to the dashboard with a success message.
     */
    public function destroy(Post $post): RedirectResponse
    {
        // Authorise the action to ensure only the post owner can delete.
        $this->authorize('delete', $post);

        // Delete the post.
        $post->delete();

        // Redirect to the dashboard with a success message.
        return redirect()->route('dashboard')->with('success', 'Post deleted successfully.');
    }

    /**
     * Handle a like/unlike action for the specified post.
     *
     * @param Post $post The post to like or unlike.
     * @return JsonResponse A JSON response with the like count and like status.
     */
    public function like(Post $post): JsonResponse
    {
        $user = auth()->user(); // Get the authenticated user.

        // Check if the user has already liked the post.
        $existingLike = $post->likes()->where('user_id', $user->id)->first();

        if ($existingLike) {
            // Unlike the post if it was already liked.
            $existingLike->delete();
            $liked = false;
        } else {
            // Like the post.
            $post->likes()->create(['user_id' => $user->id]);
            $liked = true;

            // Notify the post owner, if they are not the liker.
            if ($post->user->id !== $user->id) {
                $post->user->notify(new \App\Notifications\PostLikedNotification($post, $user));
            }
        }

        // Return a JSON response with the updated like count and status.
        return response()->json([
            'likeCount' => $post->likes()->count(),
            'liked' => $liked,
        ]);
    }
}
