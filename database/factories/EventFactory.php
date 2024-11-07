<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Venue;
use App\Models\Theme;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
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
            'name' => 'PwC' . ' ' . fake()->word .' Conference'
            'description'=> fake()->paragraph,
            'venue_id' => Venue::factory(),
            'theme_id' => Theme::factory(),
        ];
    }
}