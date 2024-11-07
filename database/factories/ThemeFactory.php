<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Theme>
 */
class ThemeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=> fake()->randomElement(['PwC Red','PwC Orange']),
            'bg_image'=>'',
            //slider settings
            'slider_effect'=>'fade',
            'slider_duration'=>'500',
            'slider_pause'=>'8000',
            'slider_easing'=>'ease',
            //custom CSS
            'custom_css'=>'body{background:#ffcc00}',
        ];
    }
}
