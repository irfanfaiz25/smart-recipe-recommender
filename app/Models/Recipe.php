<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'name',
        'description',
        'cooking_time',
        'difficulty',
        'servings',
        'image',
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
}
