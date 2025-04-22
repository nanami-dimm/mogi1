<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'exhibition_id',
        'user_id',
        'product_name',
        'price',
        'transaction_id',
        
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function exhibition()
    {
        return $this->belongsTo(Exhibition::class);
    }
    public function transaction()
    {
    return $this->belongsTo(Transaction::class);  // 1対多の関連を定義（適宜修正）
    }

}
