<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([UsersTableSeeder::class]);
        
        $this->call([ConditionsTableSeeder::class]
    );
        $this->call([ProductsTableSeeder::class]);

        $this->call([CategoriesTableSeeder::class]);

        $this->call([ExhibitionCategorySeeder::class]);

        $this->call([TransactionsTableSeeder::class]);
    }

    
}
