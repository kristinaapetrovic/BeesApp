<?php

namespace Database\Factories;

use App\Models\Drustvo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Drustvo>
 */
class DrustvoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'matica_starost' => $this->faker->numberBetween(1, 5), 
            'jacina' => $this->faker->randomElement(Drustvo::$jacina), 
            'datum_formiranja' => $this->faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
        ];
    }
}
