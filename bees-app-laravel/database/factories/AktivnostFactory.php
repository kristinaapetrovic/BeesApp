<?php

namespace Database\Factories;

use App\Models\Aktivnost;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Aktivnost>
 */
class AktivnostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $pocetak = $this->faker->dateTimeBetween('now', '+30 days');
        $kraj = (clone $pocetak)->modify('+' . rand(1, 5) . ' hours');
        return [
            'naziv' => $this->faker->sentence(3),
            'opis' => $this->faker->optional()->paragraph,
            'tip' => $this->faker->randomElement(Aktivnost::$tip),
            'pocetak' => $pocetak,
            'kraj' => $kraj,
            'status' => $this->faker->randomElement(Aktivnost::$status),
        ];
    }
}
