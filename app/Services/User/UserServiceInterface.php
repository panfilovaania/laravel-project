<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Collection;

interface UserServiceInterface
{
    public function getUsers(): Collection;

    public function getUserById(int $id): User;

    public function createUser(User $user): User;

    public function updateUser(User $user, array $data): User;

    public function deleteUser(User $user): void;
}