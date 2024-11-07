<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Display;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Timetable>
 */
class TimetableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name' => fake()->word,
            'start_at' => fake()->date,
            'end_at' =>fake()->date,
            'start_time_at' => fake()->time,
            'end_time_at' =>fake()->time,
            'description'=> fake()->paragraph,
            'item_expire_time'=> 5,
            'display_id' => Display::factory()
        ];
    }
}
