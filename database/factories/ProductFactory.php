<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(2, true),
            'category_id' => $this->faker->numberBetween(1, 4),
            'price' => $this->faker->randomFloat(2, 0, 100),
            'description' => $this->faker->sentence(rand(10, 20), true),
            'image' => $this->faker->imageUrl(),
            'is_active' => $this->faker->boolean(),
        ];
    }
}
