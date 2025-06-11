<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sugestija>
 */
class SugestijaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'poruka' => $this->faker->sentence(),
            'datum_kreiranja' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ];
    }
}
