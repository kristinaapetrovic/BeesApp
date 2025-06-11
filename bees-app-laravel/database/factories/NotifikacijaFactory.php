<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notifikacija>
 */
class NotifikacijaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tekst' => $this->faker->sentence(),
            'datum_slanja' => $this->faker->dateTimeBetween('-30 days', 'now'),
            'status' => $this->faker->boolean(30), 
        ];
    }
}
