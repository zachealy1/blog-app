<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    use HasFactory;

    // Includes factory methods for model factory support

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * Specifies the fields that can be filled via mass assignment.
     */
    protected $fillable = ['user_id', 'post_id'];

    /**
     * Define the relationship between a Like and a Post.
     * Each Like belongs to a specific Post.
     *
     * @return BelongsTo The relationship definition.
     */
    public function post(): BelongsTo
    {
        // A Like belongs to a post, defining the relationship
        return $this->belongsTo(Post::class);
    }

    /**
     * Define the relationship between a Like and a User.
     * Each Like belongs to a specific User who liked a post.
     *
     * @return BelongsTo The relationship definition.
     */
    public function user(): BelongsTo
    {
        // A Like belongs to a user, defining the relationship
        return $this->belongsTo(User::class);
    }
}
