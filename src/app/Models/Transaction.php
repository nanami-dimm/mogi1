<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable= [
        'exhibition_id','buyer_id','seller_id','status','created_at','updated_at'
    ];

    public function exhibition()
    {
    return $this->belongsTo(Exhibition::class, 'exhibition_id'); 
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
    
    public function messages()
    {
        return $this->hasMany(TransactionMessage::class);
    }

    public function rating()
    {
        return $this->hasOne(Rating::class);
    }
}
