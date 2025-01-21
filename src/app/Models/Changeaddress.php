<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Changeaddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'newpost_code',
        'new_address',
        'new_building',
    ];
}
