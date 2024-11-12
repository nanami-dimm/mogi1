<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exhibition extends Model
{
    use HasFactory;
    protected $guarded = [
       'id',
    ];
    public function categories()
    {
        return $this->belongsToMany(Category::class,'exhibition_category','exhibition_id','category_id');
    }

    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }
}
