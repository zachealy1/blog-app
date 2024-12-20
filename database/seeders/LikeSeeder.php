<?php

namespace Database\Seeders;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    /**
     * Run the like seeds.
     */
    public function run(): void
    {
        // Fetch all posts and users
        $posts = Post::all();
        $users = User::all();

        // For each post, assign random likes from random users
        $posts->each(function ($post) use ($users) {
            // Create random likes for each post
            foreach (range(1, rand(5, 15)) as $i) {
                Like::factory()->create([
                    'post_id' => $post->id,
                    'user_id' => $users->random()->id, // Assign likes from random users
                ]);
            }
        });
    }
}
