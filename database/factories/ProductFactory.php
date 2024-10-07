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
            'name' => fake()->unique()->word(),
            'description' => fake()->paragraph(),
            'image' => fake()->imageUrl(),
            'price' => fake()->numberBetween(100000, 900000),
            'discount' => fake()->randomElement([0,5,10,20,25]),
            'stock' => fake()->numberBetween(20, 500),
            'view' => fake()->numberBetween(200, 5000)
        ];
    }
}
