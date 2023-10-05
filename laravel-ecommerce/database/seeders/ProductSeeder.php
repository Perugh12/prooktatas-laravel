<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Product::factory(10)->create();

        Product::factory()->create([
            'product_category_id' => 1,
            'name' => 'Lenovo IdeaPad 3',
            'description' => '15,6"-os FHD kijelző, Intel Core i3-1005G1 processzor, 8 GB RAM, 256 GB SSD, Windows 10 Home',
            'image' => 'https://placehold.co/600x400',
            'stock' => 10,
            'unit_price' => 199990,
        ]);

        Product::factory()->create([
            'product_category_id' => 1,
            'name' => 'Lenovo IdeaPad 3',
            'description' => '15,6"-os FHD kijelző, Intel Core i3-1005G1 processzor, 8 GB RAM, 256 GB SSD, Windows 10 Home',
            'image' => 'https://placehold.co/600x400',
            'stock' => 2,
            'unit_price' => 299990,
        ]);

        Product::factory()->create([
            'product_category_id' => 1,
            'name' => 'Lenovo IdeaPad 3',
            'description' => '15,6"-os FHD kijelző, Intel Core i3-1005G1 processzor, 8 GB RAM, 256 GB SSD, Windows 10 Home',
            'image' => 'https://placehold.co/600x400',
            'stock' => 5,
            'unit_price' => 399990,
        ]);

        Product::factory()->create([
            'product_category_id' => 2,
            'name' => 'Irodai szék',
            'description' => 'Irodai szék, fekete színben, állítható magassággal',
            'image' => 'https://placehold.co/600x400',
            'stock' => 1,
            'unit_price' => 399990,
        ]);

        Product::factory()->create([
            'product_category_id' => 2,
            'name' => 'Irodai szék',
            'description' => 'Irodai szék, fekete színben, állítható magassággal',
            'image' => 'https://placehold.co/600x400',
            'stock' => 1,
            'unit_price' => 499990,
        ]);
    }
}
