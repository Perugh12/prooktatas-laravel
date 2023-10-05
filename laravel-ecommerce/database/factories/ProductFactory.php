<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_category_id' => fake()->numberBetween(1, 100),
            'name' => fake()->name(),
            'description' => fake()->text(),
            'image' => fake()->imageUrl(),
            'stock' => fake()->numberBetween(1, 100),
            'unit_price' => fake()->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL)
        ];
    }
}
