<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Exhibition;

class TransactionsTableSeeder extends Seeder
{
    public function run()
    {
        
        Transaction::create([
            'buyer_id' => 1,             // 購入者
            'seller_id' => 2,            // 出品者
            'exhibition_id' => 6,        // 取引商品ID
            'status' => 'trading',       // ステータス：取引中
        ]);
    }
}
