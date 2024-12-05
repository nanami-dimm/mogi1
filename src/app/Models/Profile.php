<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Profile extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];

    public function user()
     {
        return $this->hasone(User::class);
    }

   
    protected static function boot()
    {
    parent::boot();
    self::saving(function($profile) {
        $profile->user_id = Auth::id();
    });
    }
}
