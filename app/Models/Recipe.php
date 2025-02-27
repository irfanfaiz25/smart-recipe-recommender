<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OpenAI\Enums\Moderations\Category;

class Recipe extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'description',
        'cooking_time',
        'difficulty',
        'servings',
        'image',
        'views_count',
        'is_published'
    ];


    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'recipe_ingredients')
            ->withPivot('amount', 'unit');
    }

    public function steps()
    {
        return $this->hasMany(RecipeStep::class);
    }

    public function category()
    {
        return $this->belongsTo(RecipeCategory::class);
    }
}
