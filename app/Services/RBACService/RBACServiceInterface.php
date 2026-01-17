<?php

namespace App\Services\RBACService;

use App\Models\User;

interface RBACServiceInterface
{
    public function hasPermission(User $user, string $scope, string $action): bool;
}