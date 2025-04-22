<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('exhibitions')->insert([
            [
            'product_name' => '腕時計',
            'product_description' => 'スタイリッシュなデザインのメンズ腕時計',
            'product_image' => 'images/Armani+Mens+Clock.jpg',
            'product_price' => '15,000',
            'productcondition_id' => '1',
            'user_id' => 1,
            ],
            [
            'product_name' => 'HDD',
            'product_description' => '高速で信頼性の高いハードディスク',
            'product_image' => 'images/HDD+Hard+Disk.jpg',
            'product_price' => '5,000',
            'productcondition_id' => '2',
            'user_id' => 1,
            ],
            [
            'product_name' => '玉ねぎ3束',
            'product_description' => '新鮮な玉ねぎ3束のセット',
            'product_image' => 'images/iLoveIMG+d.jpg',
            'product_price' => '300',
            'productcondition_id' => '3',
            'user_id' => 1,
            ],
            [
            'product_name' => '革靴',
            'product_description' => 'クラシックなデザインの革靴',
            'product_image' => 'images/Leather+Shoes+Product+Photo.jpg',
            'product_price' => '4,000',
            'productcondition_id' => '4',
            'user_id' => 1,
            ],
            [
            'product_name' => 'ノートPC',
            'product_description' => '高性能なノートパソコン',
            'product_image' => 'images/Living+Room+Laptop.jpg',
            'product_price' => '45,000',
            'productcondition_id' => '1',
            'user_id' => 1,
            ],
            [
            'product_name' => 'マイク',
            'product_description' => '高品質なレコーディング用マイク',
            'product_image' => 'images/Music+Mic+4632231.jpg',
            'product_price' => '8,000',
            'productcondition_id' => '2',
            'user_id' => 2,
            ],
            [
            'product_name' => 'ショルダーバッグ',
            'product_description' => 'おしゃれなショルダーバッグ',
            'product_image' => 'images/Purse+fashion+pocket.jpg',
            'product_price' => '3,500',
            'productcondition_id' => '3',
            'user_id' => 2,
            ],
            [
            'product_name' => 'タンブラー',
            'product_description' => '使いやすいタンブラー',
            'product_image' => 'images/Tumbler+souvenir.jpg',
            'product_price' => '500',
            'productcondition_id' => '4',
            'user_id' => 2,
            ],
            [
            'product_name' => 'コーヒーミル',
            'product_description' => '手動のコーヒーミル',
            'product_image' => 'images/Waitress+with+Coffee+Grinder.jpg',
            'product_price' => '4,000',
            'productcondition_id' => '1',
            'user_id' => 2,
            ],
            [
            'product_name' => 'メイクセット',
            'product_description' => '便利なメイクアップセット',
            'product_image' => 'images/makeup.jpg',
            'product_price' => '2,500',
            'productcondition_id' => '2',
            'user_id' => 2,
            ],
        ]);
    }
}
