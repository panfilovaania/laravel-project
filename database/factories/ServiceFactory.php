<?php

namespace Database\Factories;

use App\Models\Location;
use Database\Seeders\LocationSeeder;
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
            'location_id' => Location::factory(),
            'name' => $this->faker->word . '-service-' . time() . '-' . rand(1000, 9999),
            'label' => $this->faker->word(),
            'description' => $this->faker->sentence(5),
            'price' => $this->faker->numberBetween(300, 1000),
            'resources_count' => $this->faker->numberBetween(1, 10),
            'duration_minutes' => $this->faker->randomElement([30, 60, 120]),
            'available' => $this->faker->boolean()
        ];
    }
}
