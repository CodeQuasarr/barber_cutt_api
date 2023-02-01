<?php

namespace Database\Factories\Haircuts;

use App\Models\Haircuts\HaircutReservation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<HaircutReservation>
 */
class HaircutReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'haircut_id' => $this->faker->numberBetween(1, 10),
            'user_id' => $this->faker->numberBetween(1, 10),
            'start_date' => now(),
            'start_time' => $this->faker->randomElement(['11:00', '11:30', '12:00', '12:30', '13:00', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30']),
            'status' => "pending",
        ];
    }
}
