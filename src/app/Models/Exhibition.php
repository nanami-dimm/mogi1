<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exhibition extends Model
{
    use HasFactory;
    protected $fillable = [
      'productcondition_id',
       'product_name',
       'product_description',
       'product_image',
       'product_price',
    ];
    public function categories()
    {
        return $this->belongsToMany(Category::class,'exhibition_category','exhibition_id','category_id')
        ->withPivot('product_category');
    }

    public function conditions()
    {
        return $this->belongsTo(Productcondition::class,'productcondition_id','foreign_key');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
