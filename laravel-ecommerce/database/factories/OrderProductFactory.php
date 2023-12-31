<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderProduct>
 */
class OrderProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => fake()->numberBetween(1, 100),
            'product_id' => fake()->numberBetween(1, 100),
            'quantity' => fake()->numberBetween(1, 100),
            'unit_price' => fake()->ramdomFloat(2, 1, 1000),
        ];
    }
}
