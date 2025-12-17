<?php

namespace App\Services\RBACService;

use App\Models\Permission;
use App\Models\User;

class RBACService implements RBACServiceInterface
{
    public function hasPermission(User $user, string $scope, string $action): bool
    {
        $permission = Permission::where([
            ['scope', $scope],
            ['action', $action]
        ])->first();

        $roleIds = $permission->roles()->pluck('role_id');

        $hasRole = $user->roles()
            ->whereIn('role_id', $roleIds)
            ->exists();

        return $hasRole;
    }
}