<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
     public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(),
            'label' => $this->faker->words(2, true),
            'description' => $this->faker->sentence(),
        ];
    }

    /**
     * Создает роль администратора
     */
    public function admin(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'admin',
                'label' => 'Администратор',
                'description' => 'Администратор системы',
            ];
        });
    }

    /**
     * Создает роль клиента
     */
    public function client(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'client',
                'label' => 'Клиент',
                'description' => 'Клиент',
            ];
        });
    }

    /**
     * Создает роль супер-администратора
     */
    public function superAdmin(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'super-admin',
                'label' => 'Супер администратор',
                'description' => 'Супер администратор',
            ];
        });
    }
}
