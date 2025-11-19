<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {        
        return [
            'name' => $this->faker->word(),
            'label' => $this->faker->word(),
            'description' => $this->faker->sentence(5),
            'price' => $this->faker->numberBetween(300, 1000),
            'duration_minutes' => $this->faker->randomElement([30, 60, 120]),
            'available' => $this->faker->boolean()
        ];
    }
}
