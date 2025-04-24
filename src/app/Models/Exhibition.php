<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exhibition extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'productcondition_id',
        'user_id',
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

    public function productCondition()
    {
    return $this->belongsTo(Productcondition::class, 'productcondition_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function transactions()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function transactionMessages()
{
    return $this->hasManyThrough(
        \App\Models\TransactionMessage::class,
        \App\Models\Transaction::class,
        'exhibition_id',     
        'transaction_id',    
        'id',               
        'id'                 
    );
}
    public function transaction()
{
    return $this->hasOne(Transaction::class);
}
}

