<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     * This method defines the tables for job queues, job batches, and failed jobs.
     */
    public function up(): void
    {
        // Create 'jobs' table for storing jobs that are queued for processing
        Schema::create('jobs', function (Blueprint $table) {
            $table->id(); // Auto-incrementing job ID
            $table->string('queue')->index(); // Queue name the job belongs to
            $table->longText('payload'); // Serialised job data
            $table->unsignedTinyInteger('attempts'); // Number of attempts made to process the job
            $table->unsignedInteger('reserved_at')->nullable(); // Time the job was reserved for execution (nullable)
            $table->unsignedInteger('available_at'); // Time the job is available for processing
            $table->unsignedInteger('created_at'); // Time the job was created
        });

        // Create 'job_batches' table for storing batches of jobs
        Schema::create('job_batches', function (Blueprint $table) {
            $table->string('id')->primary(); // Unique batch ID
            $table->string('name'); // Name of the batch
            $table->integer('total_jobs'); // Total number of jobs in the batch
            $table->integer('pending_jobs'); // Number of jobs still pending
            $table->integer('failed_jobs'); // Number of jobs that have failed
            $table->longText('failed_job_ids'); // IDs of failed jobs
            $table->mediumText('options')->nullable(); // Options for batch execution (nullable)
            $table->integer('cancelled_at')->nullable(); // Time the batch was canceled (nullable)
            $table->integer('created_at'); // Time the batch was created
            $table->integer('finished_at')->nullable(); // Time the batch finished processing (nullable)
        });

        // Create 'failed_jobs' table for storing jobs that failed during execution
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id(); // Auto-incrementing failed job ID
            $table->string('uuid')->unique(); // Unique job identifier
            $table->text('connection'); // Connection the job was executed on
            $table->text('queue'); // Queue name the job belonged to
            $table->longText('payload'); // Serialised job data
            $table->longText('exception'); // Exception details for the failure
            $table->timestamp('failed_at')->useCurrent(); // Time the job failed (defaults to current time)
        });
    }

    /**
     * Reverse the migrations.
     * This method drops the tables created during the migration.
     */
    public function down(): void
    {
        // Drop the 'jobs' table
        Schema::dropIfExists('jobs');

        // Drop the 'job_batches' table
        Schema::dropIfExists('job_batches');

        // Drop the 'failed_jobs' table
        Schema::dropIfExists('failed_jobs');
    }
};
