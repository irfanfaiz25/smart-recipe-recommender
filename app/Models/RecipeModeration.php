<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeModeration extends Model
{
    protected $fillable = [
        'approver_id',
        'recipe_id',
        'status',
        'notes'
    ];


    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id');
    }

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
