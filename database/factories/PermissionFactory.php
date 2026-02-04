<?php

namespace Database\Factories;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
        ];
    }

    public function createPredefinedPermissions(): Factory
    {
        $permissions = collect();

        $scopes = ['service'];
        $actions = ['create', 'delete', 'restore', 'forceDelete', 'viewAll', 'view', 'update'];

        foreach($scopes as $scope)
        {
            foreach($actions as $action)
            {
                $permissions->push([
                    'scope' => $scope,
                    'action' => $action,
                    'label' => "{$scope}:{$action}"
                ]);
            }
        }
        $result = $permissions->toArray();
        
        return $this->state(function ($result) {
            return $result;
        });
    }
}
