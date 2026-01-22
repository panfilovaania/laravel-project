<?php

namespace App\Services\User;

use App\Models\User;

interface UserServiceInterface
{
    public function getUserById(int $id): User;

    public function updateUser(User $user, array $data): User;
}