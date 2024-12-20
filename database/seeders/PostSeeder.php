<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the post seeds.
     * This method will create 3 posts for each user in the database.
     */
    public function run(): void
    {
        // Fetch all users and for each user, create 3 posts
        User::all()->each(function ($user) {
            // Use the Post factory to generate 3 posts for each user
            Post::factory(3)->create([
                'user_id' => $user->id, // Assign the post to the current user
            ]);
        });
    }
}
