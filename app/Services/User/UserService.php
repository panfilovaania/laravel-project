<?php

namespace App\Services\User;

use App\Dto\Service\CreateServiceRequestDto;
use App\Models\Role;
use App\Models\Service;
use App\Models\User;
use App\Repositories\UserRepo\UserRepoInterface;
use Illuminate\Support\Collection;

class UserService implements UserServiceInterface
{
    public function __construct(private UserRepoInterface $userRepo)
    {}
    
    public function getUserById(int $id): User
    {
        return $this->userRepo->findById($id);
    }

    public function updateUser(User $user, array $data): User
    {
        try {
            return $this->userRepo->updateUser($user, $data);
        } catch (\Exception $e) {
            throw new \App\Exceptions\User\UserUpdateException($e->getMessage());
        }
    }
}