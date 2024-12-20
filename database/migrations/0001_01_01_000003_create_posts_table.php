<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     * This method defines the 'posts' table, which stores blog posts or articles created by users.
     */
    public function up(): void
    {
        // Create 'posts' table
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key to 'users' table, deletes posts if the user is deleted
            $table->string('title'); // Title of the post
            $table->text('content'); // Content of the post
            $table->string('image')->nullable();
            $table->timestamps(); // Timestamps for 'created_at' and 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     * This method drops the 'posts' table when rolling back the migration.
     */
    public function down(): void
    {
        // Drop the 'posts' table
        Schema::dropIfExists('posts');
    }
};
