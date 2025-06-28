<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'last_login_at',
        'is_oauth_user',
        'oauth_provider',
        'is_password_changed',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'last_login_at' => 'datetime',
        ];
    }

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function getAvatarUrlAttribute()
    {
        // Return null if no avatar is set
        if (empty($this->avatar)) {
            return null;
        }

        return Str::startsWith($this->avatar, 'http')
            ? $this->avatar
            : asset('storage/' . $this->avatar);
    }

    public function bookmarkedRecipes()
    {
        return $this->belongsToMany(Recipe::class, 'bookmarks')->withTimeStamps();
    }

    public function likedRatings()
    {
        return $this->belongsToMany(Rating::class, 'rating_likes')->withTimestamps();
    }

    public function creators()
    {
        return $this->hasOne(Creator::class);
    }

    public function moderations()
    {
        return $this->hasMany(RecipeModeration::class);
    }

    public function isPasswordChanged($user)
    {
        return $user->is_password_changed ?? false;
    }
}
