<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     * This method defines the 'likes' table, which stores the likes for posts by users.
     */
    public function up(): void
    {
        // Create 'likes' table
        Schema::create('likes', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key for each like record
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Foreign key referencing 'users' table
            // Ensures that if a user is deleted.

            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            // Foreign key referencing 'posts' table
            // Ensures that if a post is deleted, all related likes are also deleted (cascade)

            $table->timestamps(); // Adds 'created_at' and 'updated_at' fields to record the time when the like was created or updated
        });
    }

    /**
     * Reverse the migrations.
     * This method will drop the 'likes' table when rolling back the migration.
     */
    public function down(): void
    {
        // Drop the 'likes' table if it exists
        Schema::dropIfExists('likes');
    }
};
