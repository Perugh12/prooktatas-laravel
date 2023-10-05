<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\OrderSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\UserAddressSeeder;
use Database\Seeders\OrderProductSeeder;
use Database\Seeders\ProductCategorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        # Itt meg lehet neki addni, hogy melyik seeder-t futtassa le, akár az összeset
        // $this->call(UserSeeder::class);
        // $this->call(UserAddressSeeder::class);
        $this->call(ProductCategorySeeder::class);
        $this->call(ProductSeeder::class);
        // $this->call(OrderSeeder::class);
        // $this->call(OrderProductSeeder::class);    
    }
}
