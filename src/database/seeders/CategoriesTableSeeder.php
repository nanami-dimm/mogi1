<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['product_category' => 'ファッション'],
            ['product_category' => '家電'],
            ['product_category' => 'インテリア'],
            ['product_category' => 'レディース'],
            ['product_category' => 'メンズ'],
            ['product_category' => 'コスメ'],
            ['product_category' => '本'],
            ['product_category' => 'ゲーム'],
            ['product_category' => 'スポーツ'],
            ['product_category' => 'キッチン'],
            ['product_category' => 'ハンドメイド'],
            ['product_category' => 'アクセサリー'],['product_category' => 'おもちゃ'],
            ['product_category' => 'ベビー・キッズ'],

        ]);
    }
}
