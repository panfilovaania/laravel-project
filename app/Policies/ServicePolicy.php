<?php

namespace App\Policies;

use App\Models\Service;
use App\Models\User;
use App\Services\User\UserServiceInterface;
use Illuminate\Auth\Access\Response;

class ServicePolicy
{
     public function __construct(private UserServiceInterface $userService)
    {}
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Service $service): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        $isAdmin = collect($this->userService->getUserRoles($user))
            ->firstWhere('name', 'admin') || 
            collect($this->userService->getUserRoles($user))
            ->firstWhere('name', 'super-admin');
    
        return $isAdmin
            ? Response::allow()
            : Response::deny('Доступ запрещен. Требуются права администратора.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Service $service): Response
    {
        $isAdmin = collect($this->userService->getUserRoles($user))
            ->firstWhere('name', 'admin') || 
            collect($this->userService->getUserRoles($user))
            ->firstWhere('name', 'super-admin');
    
        return $isAdmin
            ? Response::allow()
            : Response::deny('Доступ запрещен. Требуются права администратора.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Service $service): Response
    {
        $isSuperAdmin = collect($this->userService->getUserRoles($user))
            ->contains('name', 'super-admin');
    
        return $isSuperAdmin
            ? Response::allow()
            : Response::deny('Доступ запрещен. Требуются права супер администратора.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Service $service): Response
    {
         $isSuperAdmin = collect($this->userService->getUserRoles($user))
            ->contains('name', 'super-admin');
    
        return $isSuperAdmin
            ? Response::allow()
            : Response::deny('Доступ запрещен. Требуются супер администратора.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Service $service): Response
    {
         $isSuperAdmin = collect($this->userService->getUserRoles($user))
            ->contains('name', 'super-admin');
    
        return $isSuperAdmin
            ? Response::allow()
            : Response::deny('Доступ запрещен. Требуются супер администратора.');
    }
}
