<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class View extends Model
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
        'post_id',
        'user_id',
        'ip_address',
    ];

    /**
     * The post that the view belongs to.
     */
    public function post(): BelongsTo
    {
        // A View belongs to a post, defining the relationship
        return $this->belongsTo(Post::class);
    }

    /**
     * The user that the view belongs to (nullable for guest views).
     */
    public function user(): BelongsTo
    {
        // A View belongs to a user, defining the relationship
        return $this->belongsTo(User::class);
    }
}
