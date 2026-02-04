<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resource>
 */
class ResourceFactory extends Factory
{
   public function definition(): array
    {       
        return [
            'name' => $this->faker->word . '-resource-' . time() . '-' . rand(1000, 9999),
            'label' => $this->faker->word(),
            'available' => $this->faker->boolean()
        ];
    }
}
