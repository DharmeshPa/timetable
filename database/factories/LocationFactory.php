<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Venue;
use Illuminate\Support\Arr;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
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
            'name' => ucfirst(fake()->word) .' '. Arr::random(
                ['Room', 'Conference room','Pavillion Room','Orange room','Business center','Ballroom A, B & C'
            ]),
            'venue_id' => Venue::factory()
        ];
    }
}
