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
        return $this->belongsToMany(Category::class,'exhibition_category','exhibition_id','category_id');
    }

    public function conditions()
    {
        return $this->belongsTo(Productcondition::class,'productcondition_id','foreign_key');
    }
}
