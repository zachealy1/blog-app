<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     * This method defines the 'comments' table, which stores comments made by users on posts.
     */
    public function up(): void
    {
        // Create 'comments' table
        Schema::create('comments', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->foreignId('user_id')->constrained(); // Foreign key to 'users' table
            $table->foreignId('post_id')->constrained()->onDelete('cascade'); // Foreign key to 'posts' table, deletes comments if the post is deleted
            $table->text('body'); // Content of the comment
            $table->timestamps(); // Timestamps for 'created_at' and 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     * This method drops the 'comments' table when rolling back the migration.
     */
    public function down(): void
    {
        // Drop the 'comments' table
        Schema::dropIfExists('comments');
    }
};
