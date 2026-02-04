<?php

namespace Database\Factories;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'phone' => $this->faker->numerify('+79#########'),
            'birthday' => $this->faker->date()
        ];
    }

    public function admin()
    {
        return $this->afterCreating(function (User $user) {
            $adminRole = Role::firstOrCreate(
                [
                    'name' => 'admin',
                    'label' => 'Администратор',
                    'description' => 'Администратор системы',
                ]
            );
            
            $scopes = ['service', 'resource'];
            $actions = ['create', 'viewAll', 'view', 'update'];
            
            foreach($scopes as $scope)
            {
                foreach($actions as $action)
                {
                    $permission = Permission::firstOrCreate([
                        'scope' => $scope,
                        'action' => $action,
                        'label' => "{$scope}:{$action}"
                    ]);

                    $adminRole->permissions()->attach($permission);
                }
            }
            
            $user->roles()->attach($adminRole);
        });
    }

    public function superAdmin()
    {
        return $this->afterCreating(function (User $user) {
            $adminRole = Role::firstOrCreate(
                [
                    'name' => 'super-admin',
                    'label' => 'Супер администратор',
                    'description' => 'Супер администратор системы',
                ]
            );
            
            $scopes = ['service', 'resource'];
            $actions = ['create', 'delete', 'restore', 'forceDelete', 'viewAll', 'view', 'update'];
            
            foreach($scopes as $scope)
            {
                foreach($actions as $action)
                {
                    $permission = Permission::firstOrCreate([
                        'scope' => $scope,
                        'action' => $action,
                        'label' => "{$scope}:{$action}"
                    ]);

                    $adminRole->permissions()->attach($permission);
                }
            }
            
            $user->roles()->attach($adminRole);
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
        ]);
    }
}
