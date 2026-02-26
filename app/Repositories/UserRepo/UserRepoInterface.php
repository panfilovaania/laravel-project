<?php

namespace App\Repositories\UserRepo;

use App\Dto\User\CreateUserRequestDto;
use App\Models\User;
use Illuminate\Support\Collection;

interface UserRepoInterface
{
    public function getUsers(): Collection;
    public function findById(int $id): User;
    public function getUserRoles(User $user): Collection;
    public function createUser(array $data): User;
    public function updateUser(User $user, array $data): User;
    public function deleteUser(User $user): bool;
}