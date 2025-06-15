<?php

namespace Database\Factories;

use App\Models\Kosnica;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kosnica>
 */
class KosnicaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'oznaka' => $this->faker->bothify('KSN-###'),
            'tip' => $this->faker->randomElement(['Langstroth', 'Dadant', 'Top-Bar', 'Warre']),
            'status' => $this->faker->randomElement(Kosnica::$status),
        ];
    }
}
