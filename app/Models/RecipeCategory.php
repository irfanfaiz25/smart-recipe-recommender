<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeCategory extends Model
{
    public $fillable = [
        'name',
        'description',
    ];


    public function recipes()
    {
        return $this->hasMany(Recipe::class, 'category_id');
    }
}
