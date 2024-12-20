<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    // Includes factory methods for model factory support

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * Specifies which fields can be filled via mass assignment.
     */
    protected $fillable = [
        'title',
        'content',
        'user_id',
        'image',
    ];

    /**
     * Defines the relationship between a Post and a User.
     * A post belongs to a user, meaning each post is created by a specific user.
     *
     * @return BelongsTo The relationship definition.
     */
    public function user(): BelongsTo
    {
        // A Post belongs to a user, defining the relationship
        return $this->belongsTo(User::class);
    }

    /**
     * Defines the relationship between a Post and its Comments.
     * A post can have many comments associated with it.
     *
     * @return HasMany The relationship definition.
     */
    public function comments(): HasMany
    {
        // A Post has many comments, defining the relationship
        return $this->hasMany(Comment::class);
    }

    /**
     * Defines the relationship between a Post and its Likes.
     * A post can have many likes.
     *
     * @return HasMany The relationship definition.
     */
    public function likes(): HasMany
    {
        // A Post has many likes, defining the relationship
        return $this->hasMany(Like::class);
    }

    /**
     * The views that belong to the post.
     */
    public function views(): HasMany
    {
        // A Post has many views, defining the relationship
        return $this->hasMany(View::class);
    }

    /**
     * Accessor method to dynamically calculate the view count for a post.
     *
     * @return int The total number of views for the post.
     */
    public function getViewCountAttribute(): int
    {
        // Count the number of related 'views' and return the count
        return $this->views()->count();
    }

    /**
     * Accessor for dynamically calculating the number of comments on a post.
     *
     * @return int The total number of comments for the post.
     */
    public function getCommentCountAttribute(): int
    {
        // Count the number of comments associated with this post
        return $this->comments()->count();
    }

    /**
     * Accessor to dynamically calculate the number of likes on a post.
     *
     * @return int The total number of likes for the post.
     */
    public function getLikeCountAttribute(): int
    {
        // Count the number of likes associated with this post
        return $this->likes()->count();
    }
}
