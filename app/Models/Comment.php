<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    // Includes factory methods for model factory support

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * Specifies the fields that can be filled via mass assignment.
     */
    protected $fillable = [
        'user_id', // The ID of the user who created the comment
        'post_id', // The ID of the post to which the comment belongs
        'body',    // The content of the comment
    ];

    /**
     * Get the user that owns the comment.
     * This defines the relationship between the comment and the user.
     * A comment belongs to a specific user.
     *
     * @return BelongsTo The relationship definition.
     */
    public function user(): BelongsTo
    {
        // A Comment belongs to a user, defining the relationship
        return $this->belongsTo(User::class);
    }

    /**
     * Get the post that the comment belongs to.
     * This defines the relationship between the comment and the post.
     * A comment belongs to a specific post.
     *
     * @return BelongsTo The relationship definition.
     */
    public function post(): BelongsTo
    {
        // A Comment belongs to a post, defining the relationship
        return $this->belongsTo(Post::class);
    }
}
