<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticate;
use Illuminate\Notifications\Notifiable;

class User extends Authenticate
{
    use HasFactory, Notifiable;

    // Use the HasFactory trait for creating factory instances and the Notifiable trait for enabling notifications for the User model

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     * These fields will not be included when the model is converted to an array or JSON.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',        // User's password
        'remember_token',  // Token used to remember users between sessions
    ];

    /**
     * Cast attributes to specific types.
     * This function defines how certain fields should be automatically cast when retrieved.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',  // Cast 'email_verified_at' to a datetime object
            'password' => 'hashed',             // Automatically hash 'password' when saving
        ];
    }

    /**
     * Define the relationship: A user has many posts.
     * This indicates that the user can be associated with multiple posts.
     *
     * @return HasMany
     */
    public function posts(): HasMany
    {
        // A User has many posts, defining the relationship
        return $this->hasMany(Post::class);
    }

    /**
     * Define the relationship: A user has many comments.
     * This indicates that the user can be associated with multiple comments.
     *
     * @return HasMany
     */
    public function comments(): HasMany
    {
        // A User has many comments, defining the relationship
        return $this->hasMany(Comment::class);
    }

    /**
     * Define the relationship: A user has many views.
     * This indicates that the user can be associated with multiple views (if implemented).
     *
     * @return HasMany
     */
    public function views(): HasMany
    {
        // A User has many views, defining the relationship
        return $this->hasMany(View::class); // A User has many views
    }

    /**
     * Check if the user is an admin.
     * This method checks if the 'admin' attribute is true for the user.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->admin; // Return true if the user is an admin, false otherwise
    }

    /**
     * Accessor for the "name" attribute.
     *
     * This method combines the `first_name` and `last_name` properties
     * into a single string, separated by a space, and returns it.
     *
     * @return string The full name composed of first and last names.
     */
    public function getNameAttribute(): string
    {
        // Concatenate the first and last names with a space in between and return the result.
        return $this->first_name . ' ' . $this->last_name;
    }
}
