<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(1, 100),
            'status' => fake()->randomElement(['pedding', 'processing', 'completed', 'decline']),
            'payment_method' => fake()->randomElement(['cash', 'card', 'paypal']),
            'shipping_method' => fake()->randomElement(['post', 'delivery', 'pickup']),

            'payment_firstname' => fake()->firstName(),
            'payment_lastname' => fake()->lastName(),
            'payment_phone' => fake()->phoneNumber(),
            'payment_email' => fake()->unique()->safeEmail(),
            'payment_company' => fake()->company(),
            'payment_country' => fake()->country(),
            'payment_state' => fake()->state(),
            'payment_zipcode' => fake()->postcode(),
            'payment_city' => fake()->city(),
            'payment_street_name' => fake()->streetName(),
            'payment_street_type' => fake()->streetSuffix(),
            'payment_house_number' => fake()->buildingNumber(),
            'payment_building_number' => fake()->buildingNumber(),
            'payment_floor_number' => fake()->buildingNumber(),
            'payment_apartment_number' => fake()->buildingNumber(),

            'shipping_firstname' => fake()->firstName(),
            'shipping_lastname' => fake()->lastName(),
            'shipping_phone' => fake()->phoneNumber(),
            'shipping_email' => fake()->unique()->safeEmail(),
            'shipping_company' => fake()->company(),
            'shipping_country' => fake()->country(),
            'shipping_state' => fake()->state(),
            'shipping_zipcode' => fake()->postcode(),
            'shipping_city' => fake()->city(),
            'shipping_street_name' => fake()->streetName(),
            'shipping_street_type' => fake()->streetSuffix(),
            'shipping_house_number' => fake()->buildingNumber(),
            'shipping_building_number' => fake()->buildingNumber(),
            'shipping_floor_number' => fake()->buildingNumber(),
            'shipping_apartment_number' => fake()->buildingNumber()            
        ];
    }
}

?>

<?php if?>
