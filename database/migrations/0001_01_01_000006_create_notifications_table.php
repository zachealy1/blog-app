<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     * This method defines the 'notifications' table, which stores notifications for users or other notifiable entities.
     */
    public function up(): void
    {
        // Create the 'notifications' table
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Unique identifier for each notification, stored as UUID
            $table->string('type'); // The type of notification, representing its class
            $table->morphs('notifiable'); // Morphs method creates columns for the polymorphic relation (id and type)
            $table->text('data'); // The notification data, stored as a text field (JSON-encoded or similar)
            $table->timestamp('read_at')->nullable(); // A timestamp indicating when the notification was read, nullable if unread
            $table->timestamps(); // Standard timestamps for 'created_at' and 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     * This method drops the 'notifications' table when rolling back the migration.
     */
    public function down(): void
    {
        // Drop the 'notifications' table
        Schema::dropIfExists('notifications');
    }
};
