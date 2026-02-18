<?php

namespace App\Repositories\UserRepo;

use App\Models\User;
use Illuminate\Support\Collection;

interface UserRepoInterface
{
    public function getUsers(): Collection;
    public function findById(int $id): User;
    public function getUserRoles(User $user): Collection;
    public function createUser(User $user): User;
    public function updateUser(User $user, array $data): User;
    public function deleteUser(User $user): bool;
}