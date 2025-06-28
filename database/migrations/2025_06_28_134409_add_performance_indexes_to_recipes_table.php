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
        Schema::table('recipes', function (Blueprint $table) {
            // 1. INDEX UTAMA - Untuk scope approved() yang paling sering digunakan
            $table->index(['is_published', 'created_at'], 'recipes_published_created_index');

            // 2. INDEX UNTUK FILTERING - Kombinasi filter yang sering digunakan
            $table->index(['is_published', 'category_id'], 'recipes_published_category_index');
            $table->index(['is_published', 'user_id'], 'recipes_published_user_index');

            // 3. INDEX UNTUK SORTING POPULARITAS - Views count sangat sering digunakan
            $table->index(['is_published', 'views_count'], 'recipes_published_views_index');

            // 4. INDEX UNTUK RANGE QUERIES - Cooking time dan calories
            $table->index(['is_published', 'cooking_time'], 'recipes_published_time_index');
            $table->index(['is_published', 'calories'], 'recipes_published_calories_index');

            // 5. INDEX UNTUK PENCARIAN - Name field untuk LIKE queries
            $table->index('name', 'recipes_name_index');

            // 6. INDEX UNTUK DIFFICULTY FILTER
            // $table->index(['is_published', 'difficulty'], 'recipes_published_difficulty_index');

            // 7. INDEX UNTUK SERVINGS (jika digunakan untuk filtering)
            // $table->index('servings', 'recipes_servings_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->dropIndex('recipes_published_created_index');
            $table->dropIndex('recipes_published_category_index');
            $table->dropIndex('recipes_published_user_index');
            $table->dropIndex('recipes_published_views_index');
            $table->dropIndex('recipes_published_time_index');
            $table->dropIndex('recipes_published_calories_index');
            $table->dropIndex('recipes_name_index');
            // $table->dropIndex('recipes_published_difficulty_index');
            // $table->dropIndex('recipes_servings_index');
        });
    }
};
