<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Crew>
 */
class CrewFactory extends Factory
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
            'name' => fake()->title . ' '.fake()->firstName .' '.ucfirst(fake()->word),
            'email'=>fake()->email,
            'phone'=>fake()->phoneNumber,
            'description'=>fake()->paragraph
        ];
    }
}