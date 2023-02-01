<?php

namespace Database\Factories\OtherProduct;

use App\Models\OtherProduct\Product;
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
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'category_product_id' => $this->faker->numberBetween(1, 10),
            'price' => $this->faker->randomFloat(2, 0, 1000),
            'is_active' => $this->faker->boolean,
            'image' => 'https://picsum.photos/200/300'
        ];
    }
}
