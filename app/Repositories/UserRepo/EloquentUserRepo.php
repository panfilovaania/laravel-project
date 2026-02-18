<?php

namespace App\Repositories\UserRepo;

use App\Models\Service;
use App\Models\User;
use App\Repositories\UserRepo\UserRepoInterface;
use Illuminate\Support\Collection;

class EloquentUserRepo implements UserRepoInterface
{
    public function getUsers(): Collection
    {
        return User::all();
    }

    public function findById(int $id): User
    {
        return User::findOrFail($id);
    }

    public function getUserRoles(User $user): Collection
    {
        return $user->roles()->get();
    }

    public function createUser(User $user): User
    {
        return User::create($user);
    }

    public function updateUser(User $user, array $data): User
    {
        $user->update($data);
        
        return $user->fresh();
    }

    public function deleteUser(User $user): bool
    {
        return $user->delete();
    }
}