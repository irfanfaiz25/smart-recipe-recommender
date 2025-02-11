<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = [
        'name',
        'category',
        'image',
        'description'
    ];


    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class);
    }
}
