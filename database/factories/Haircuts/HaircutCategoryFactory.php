<?php

namespace Database\Factories\Haircuts;

use App\Models\Haircuts\HaircutCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<HaircutCategory>
 */
class HaircutCategoryFactory extends Factory
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
        ];
    }
}
