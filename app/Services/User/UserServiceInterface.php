<?php

namespace App\Services\User;

use App\Models\User;

use Illuminate\Support\Collection;

interface UserServiceInterface
{
    public function getUsers(): Collection;

    public function getUserRoles(User $user): Collection;

    public function updateUser(User $user, array $data): User;
}