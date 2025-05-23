<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable= [
        'name','email','password','post_code','address','building','profile_image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    
    public function exhibitions()
    {
        return $this->hasMany(Exhibition::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function receivedRatings()
{
    return $this->hasMany(Rating::class, 'target_user_id');
}

public function getAverageRatingAttribute()
{
    $average = $this->receivedRatings()->avg('rating');
    return $average ? round($average) : null;
}
}
