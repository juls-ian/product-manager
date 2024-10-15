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
            //MAPPING table columns
            'name' => fake()->sentence(),
            'brand' => fake()->sentence(2),
            'price' => fake()->randomDigitNot(0) * 100, //generate 0-9 excluding 0
            'weight' => fake()->randomDigitNot(0), // 2 decimal limit
            'desc' => fake()->text(),
        ];
    }
}
