<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'user_id',
        'recipe_id',
        'rating',
        'comment',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    public function likedBy()
    {
        return $this->belongsToMany(User::class, 'rating_likes')->withTimestamps();
    }

    public function isLikedBy($user)
    {
        return $this->likedBy()->where('user_id', $user->id)->exists();
    }
}
