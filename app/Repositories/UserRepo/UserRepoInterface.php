<?php

namespace App\Repositories\UserRepo;

use App\Models\User;
use Illuminate\Support\Collection;

interface UserRepoInterface
{
    public function getUsers(): Collection;
    public function findById(int $id): User;
    public function getUserRoles(User $user): Collection;
    public function updateUser(User $user, array $data): User;
}