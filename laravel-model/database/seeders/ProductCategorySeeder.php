<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductCategory::factory()->create(
            [
                'name' => 'Test User 3',
            ]
        );

        ProductCategory::insert([
            'name' => 'Test Use 2',
        ]);
    }
}
