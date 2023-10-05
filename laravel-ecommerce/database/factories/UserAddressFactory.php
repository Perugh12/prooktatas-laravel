<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserAddress>
 */
class UserAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'company' => fake()->company(),
            'country' => fake()->country(),
            'state' => fake()->state(),
            'zipcode' => fake()->postcode(),
            'city' => fake()->city(),
            'street_name' => fake()->streetName(),
            'street_type' => fake()->streetSuffix(),
            'house_number' => fake()->buildingNumber(),
            'building_number' => fake()->buildingNumber(),
            'floor_number' => fake()->buildingNumber(),
            'apartment_number' => fake()->buildingNumber()
        ];
    }
}
