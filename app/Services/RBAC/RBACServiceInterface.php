<?php

namespace App\Services\RBAC;

use App\Models\User;

interface RBACServiceInterface
{
    public function hasPermission(User $user, string $scope, string $action): bool;
}