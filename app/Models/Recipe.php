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
        'calories',
        'views_count',
        'is_published'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'recipe_ingredients')
            ->withPivot('amount', 'unit', 'is_primary');
    }

    public function steps()
    {
        return $this->hasMany(RecipeStep::class);
    }

    public function category()
    {
        return $this->belongsTo(RecipeCategory::class);
    }

    public function bookmarkedBy()
    {
        return $this->belongsToMany(User::class, 'bookmarks')->withTimestamps();
    }

    public function isBookmarkedBy($user)
    {
        return $this->bookmarkedBy()->where('user_id', $user->id)->exists();
    }

    public function moderation()
    {
        return $this->hasOne(RecipeModeration::class);
    }

    public function cookingHistories()
    {
        return $this->hasMany(CookingHistory::class);
    }

    public function cookedByUsers()
    {
        return $this->belongsToMany(User::class, 'cooking_histories')
            ->withPivot('cooked_at', 'notes')
            ->withTimestamps();
    }

    public function scopeApproved($query)
    {
        return $query->where('is_published', true)
            ->whereHas('moderation', function ($subQuery) {
                $subQuery->where('status', 'approved');
            });
    }
}
