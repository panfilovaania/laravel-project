<?php

namespace App\Services\User;

use App\Exceptions\Service\ServiceOperationException;
use App\Exceptions\User\UserUpdateException;
use App\Models\User;
use App\Repositories\UserRepo\UserRepoInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class UserService implements UserServiceInterface
{
    public function __construct(private UserRepoInterface $userRepo)
    {}
    
    public function getUsers(): Collection
    {
        return $this->userRepo->getUsers();
    }

    public function getUserById(int $id): User
    {
        return $this->userRepo->findById($id);
    }

    public function createUser(User $user): User
    {
        try {
            return $this->userRepo->createUser($user);
        } catch (\Exception $e) {
            Log::channel('user')->error("Ошибка при создании пользователя: ", [
                'message' => $e->getMessage(),
                'input' => request()->all()
            ]);

            throw new ServiceOperationException("Не удалось создать пользователя: {$e->getMessage()}");
        }
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

    public function deleteUser(User $user): void
    {
        if (!$this->userRepo->deleteUser($user)) {
            Log::channel('user')->error("Ошибка при удалении пользователя: ", [
                'input' => request()->all()
            ]);
            throw new ServiceOperationException("Не удалось удалить пользователя");
        }
    }
}