<?php

namespace App\Policies;

use App\Models\Service;
use App\Models\User;
use App\Services\RBACService\RBACServiceInterface;
use App\Services\User\UserServiceInterface;
use Illuminate\Auth\Access\Response;

class ServicePolicy
{
     public function __construct(private UserServiceInterface $userService,
        private RBACServiceInterface $RBACService)
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
        $canView = $this->RBACService->hasPermission($user, 'service', 'view');

        return $canView;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        $canCreate = $this->RBACService->hasPermission($user, 'service', 'create');

        return $canCreate;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Service $service): bool
    {
        $canUpdate = $this->RBACService->hasPermission($user, 'service', 'update');
    
        return $canUpdate;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Service $service): bool
    {
        $canDelete = $this->RBACService->hasPermission($user, 'service', 'delete');
    
        return $canDelete;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Service $service): bool
    {
        $canRestore = $this->RBACService->hasPermission($user, 'service', 'restore');
    
        return $canRestore;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Service $service): bool
    {
        $canForceDelete = $this->RBACService->hasPermission($user, 'service', 'forceDelete');
    
        return $canForceDelete;
    }
}
