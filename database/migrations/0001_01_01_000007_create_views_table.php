<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     * This method defines the 'views' table, which stores the views of users.
     */
    public function up(): void
    {
        // Create the 'views' table
        Schema::create('views', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key for each like record
            $table->foreignId('post_id')->constrained()->onDelete('cascade'); // The post being viewed
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // The user viewing the post (nullable for guest views)
            $table->timestamps(); // Track when the view happened
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the 'views' table
        Schema::dropIfExists('views');
    }
};
