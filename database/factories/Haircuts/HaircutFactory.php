<?php

namespace Database\Factories\Haircuts;

use App\Models\Haircuts\Haircut;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Haircut>
 */
class HaircutFactory extends Factory
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
            'price' => $this->faker->numberBetween(30, 100),
            'haircut_category_id' => $this->faker->numberBetween(1, 3),
        ];
    }
}
