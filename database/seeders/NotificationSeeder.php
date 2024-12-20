<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Post;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds for notifications.
     *
     * This seeder generates notifications for users, including:
     * - Comment notifications: Simulating comments on posts.
     * - Like notifications: Simulating likes on posts.
     */
    public function run(): void
    {
        // Retrieve all users and posts for seeding notifications.
        $users = User::all();
        $posts = Post::all();

        // Iterate through each user to generate notifications.
        foreach ($users as $user) {
            // Generate 5 comment notifications for each user.
            foreach (range(1, 5) as $i) {
                $randomPost = $posts->random(); // Randomly select a post.
                $commenter = $users->random(); // Randomly select a commenter.

                // Insert a comment notification into the database.
                DB::table('notifications')->insert([
                    'id' => Str::uuid()->toString(), // Generate a unique UUID for the notification.
                    'type' => \App\Notifications\CommentNotification::class, // Specify the notification type.
                    'notifiable_id' => $user->id, // The user being notified.
                    'notifiable_type' => 'App\Models\User', // The type of notifiable model.
                    'data' => json_encode([
                        'message' => "{$commenter->name} commented on your post: '{$randomPost->title}'",
                        'post_id' => $randomPost->id,
                        'commenter_id' => $commenter->id,
                    ]), // Store relevant notification data in JSON format.
                    'created_at' => now(), // Set the creation timestamp.
                    'updated_at' => now(), // Set the updated timestamp.
                ]);
            }

            // Generate 5 like notifications for each user.
            foreach (range(1, 5) as $i) {
                $randomPost = $posts->random(); // Randomly select a post.
                $liker = $users->random(); // Randomly select a liker.

                // Insert a like notification into the database.
                DB::table('notifications')->insert([
                    'id' => Str::uuid()->toString(), // Generate a unique UUID for the notification.
                    'type' => \App\Notifications\PostLikedNotification::class, // Specify the notification type.
                    'notifiable_id' => $user->id, // The user being notified.
                    'notifiable_type' => 'App\Models\User', // The type of notifiable model.
                    'data' => json_encode([
                        'message' => "{$liker->name} liked your post: '{$randomPost->title}'",
                        'post_id' => $randomPost->id,
                        'liker_id' => $liker->id,
                    ]), // Store relevant notification data in JSON format.
                    'created_at' => now(), // Set the creation timestamp.
                    'updated_at' => now(), // Set the updated timestamp.
                ]);
            }
        }
    }
}
