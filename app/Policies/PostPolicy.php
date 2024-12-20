<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * PostPolicy defines the authorisation logic for actions on Post models.
 *
 * This policy uses Laravel's authorisation system to manage access control
 * for updating and deleting posts, based on user roles and ownership.
 */
class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given post can be updated by the user.
     *
     * This policy allows updates if:
     * - The user is the owner of the post, OR
     * - The user has admin privileges.
     *
     * @param User $user The currently authenticated user.
     * @param Post $post The post being checked for update permission.
     * @return bool True if the user is authorised to update the post, false otherwise.
     */
    public function update(User $user, Post $post): bool
    {
        // Check if the user is the post owner or an admin.
        return $user->id === $post->user_id || $user->isAdmin();
    }

    /**
     * Determine if the given post can be deleted by the user.
     *
     * This policy allows deletion if:
     * - The user is an admin (can delete any post), OR
     * - The user is the owner of the post.
     *
     * @param User $user The currently authenticated user.
     * @param Post $post The post being checked for delete permission.
     * @return bool True if the user is authorised to delete the post, false otherwise.
     */
    public function delete(User $user, Post $post): bool
    {
        // Admins are authorised to delete any post.
        if ($user->isAdmin()) {
            return true;
        }

        // Regular users can only delete their own posts.
        return $user->id === $post->user_id;
    }
}
