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
                
                'created_at'        => now(),
                'updated_at'        => now(),],
            [
                'name' => '渚カヲル',
                'email' => 'nagisakaworu@test.com',
                'password'          => Hash::make('kaworu3456'),
                
                'created_at'        => now(),
                'updated_at'        => now(),],
            [
                'name' => '碇ゲンドウ',
                'email' => 'ikarigendou@test.com',
                'password'          => Hash::make('gendou7890'),
                
                'created_at'        => now(),
                'updated_at'        => now(),
            ],

        ]);
    }
    
}

