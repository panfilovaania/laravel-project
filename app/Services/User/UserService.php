<?php

namespace App\Services\User;

use App\Exceptions\User\UserUpdateException;
use App\Models\User;
use App\Repositories\UserRepo\UserRepoInterface;
use Illuminate\Support\Facades\Log;

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
            Log::error("Ошибка обновления пользователя: {$e->getMessage()}");

            throw new UserUpdateException($e->getMessage());
        }
    }
}