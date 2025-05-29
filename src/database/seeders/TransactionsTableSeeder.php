<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TransactionsTableSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        DB::table('transactions')->insert([
        [
            'buyer_id' => 1,            
            'seller_id' => 2,            
            'exhibition_id' => 6,       
            'status' => 'trading',      
            'created_at' => $now,
            'updated_at' => $now,
        ],
        [
            'buyer_id' => 1,             
            'seller_id' => 2,            
            'exhibition_id' => 7,        
            'status' => 'trading', 
            'created_at' => $now,
            'updated_at' => $now,
        ],
        [
            'buyer_id' => 3,             
            'seller_id' => 1,            
            'exhibition_id' => 4,        
            'status' => 'trading', 
            'created_at' => $now,
            'updated_at' => $now,
        ],
        ]);

        DB::table('exhibitions')->whereIn('id', [6, 7, ])->update([
            'status' => 'trading',
            'updated_at' => $now,
        ]);
        
    }
}
