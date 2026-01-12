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

    public function updateUser(User $user, array $data): User
    {
        $user->update($data);
        
        return $user->fresh();
    }

    public function deleteService(int $id): bool
    {
        return Service::findOrFail($id)->delete();
    }
}