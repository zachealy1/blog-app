<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Post;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Generate or associate a user
            'post_id' => Post::factory(), // Generate or associate a post
            'body' => $this->faker->sentence, // Generate a random sentence for the comment body
        ];
    }
}
