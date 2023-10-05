<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ProductCategory::factory(2)->create();

        ProductCategory::factory()->create([
            'name' => 'Laptop',
            'slug' => 'laptopok',
        ]);

        ProductCategory::factory()->create([
            'name' => 'Irodai szék',
            'slug' => 'irodai-szek',
        ]);
    }
}
