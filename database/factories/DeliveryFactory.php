<?php

namespace Database\Factories;

use App\Models\Delivery;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DeliveryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $point = ['本社', '笹井', '日高'];

        return [
            'product_name' => fake()->realText(10),
            'departure' => fake()->randomElement($point),
            'destination' => fake()->randomElement($point),
            'departure_datetime' => fake()->dateTimeBetween('-1 month', '-1 week'),
            'destination_datetime' => fake()->dateTimeBetween('-1 week', 'now'),
            'receipt_datetime' => fake()->optional()->dateTimeBetween('now', '+1 week'),
            'order_number' => fake()->optional()->numerify('######'),
            'requester' => fake()->name, // 日本人名
            'count' => fake()->randomNumber(1, 20)
        ];
    }
}
