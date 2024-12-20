<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\View;
use Illuminate\Database\Seeder;

class ViewSeeder extends Seeder
{
    /**
     * Run the view seeds.
     */
    public function run(): void
    {
        // Fetch all posts and users
        $posts = Post::all();
        $users = User::all();

        // For each post, add random views
        $posts->each(function ($post) use ($users) {
            // Create random views for this post using the factory
            foreach (range(1, rand(5, 15)) as $i) {
                View::factory()->create([
                    'post_id' => $post->id,
                    'user_id' => $users->random()->id, // Random user viewing the post
                ]);
            }
        });
    }
}
