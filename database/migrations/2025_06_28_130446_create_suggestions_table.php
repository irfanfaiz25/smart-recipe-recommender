<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('suggestions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');

            // Main feedback fields
            $table->string('feedback_type', 50);
            $table->tinyInteger('rating')->unsigned();
            $table->string('subject', 100);
            $table->text('feedback_message');
            $table->string('specific_area', 50);
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');

            // User experience ratings
            $table->tinyInteger('ease_of_use')->unsigned();
            $table->tinyInteger('performance')->unsigned();
            $table->tinyInteger('design')->unsigned();
            $table->boolean('would_recommend')->default(true);
            $table->text('additional_features')->nullable();

            // Contact information
            $table->string('name', 50)->nullable();
            $table->string('email', 100)->nullable();

            // System tracking
            $table->ipAddress('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->enum('status', ['pending', 'reviewed', 'implemented', 'rejected'])->default('pending');
            $table->text('admin_notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suggestions');
    }
};
