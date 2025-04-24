<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => '碇シンジ',
                'email'=>'ikarisinji@test.com',
                'password'          => Hash::make('sinji1234'),
                'profile_image' => 'storage/images/shinji.jpg',
                'post_code' => '123-4567',
                'address' => '第3新東京市 芦ノ湖沿い',
                'building' => 'NERV職員宿舎A棟',
                'created_at'        => now(),
                'updated_at'        => now(),],
            [
                'name' => '渚カヲル',
                'email' => 'nagisakaworu@test.com',
                'password'          => Hash::make('kaworu3456'),
                'profile_image' => 'storage/images/kaworu.jpg',
                'post_code' => '234-5678',
                'address' => '月面基地タブハベース',
                'building' => '第5使徒監視区画',
                'created_at'        => now(),
                'updated_at'        => now(),],
            [
                'name' => '碇ゲンドウ',
                'email' => 'ikarigendou@test.com',
                'password'          => Hash::make('gendou7890'),
                'profile_image' => 'storage/images/gendou.jpg',
                'post_code' => '345-6789',
                'address' => 'ネルフ本部 地下深部',
                'building' => '司令室',

                'created_at'        => now(),
                'updated_at'        => now(),
            ],

        ]);
    }
    
}

