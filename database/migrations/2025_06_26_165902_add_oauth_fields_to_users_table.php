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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_oauth_user')->default(false);
            $table->string('oauth_provider')->nullable(); // 'google', 'facebook', etc.
            $table->boolean('is_password_changed')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_oauth_user');
            $table->dropColumn('oauth_provider');
            $table->dropColumn('is_password_changed');
        });
    }
};
