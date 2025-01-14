<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PaymethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('paymethods')->insert([
            ['name' => 'コンビニ支払い',],
            [
                'name' => 'カード支払い',
            ],
        ]);
    }
}
