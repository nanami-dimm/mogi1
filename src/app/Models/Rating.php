<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $fillable= ['transaction_id','user_id','rating','target_user_id'];

    public function reviewer() // 評価した人
    {
    return $this->belongsTo(User::class, 'user_id');
    }

    public function reviewee() // 評価された人
    {
    return $this->belongsTo(User::class, 'target_user_id');
    }
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

}
