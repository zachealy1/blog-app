<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the comment seeds.
     * This method seeds the database with comments for each post.
     */
    public function run(): void
    {
        // Iterate through each post in the database
        Post::all()->each(function ($post) {
            // For each post, create 5 comments associated with it
            Comment::factory(5)->create([
                'post_id' => $post->id, // Associate the comment with the current post
            ]);
        });
    }
}
