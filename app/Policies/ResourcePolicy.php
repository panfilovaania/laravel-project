<?php

namespace App\Policies;

use App\Models\Resource;
use App\Models\User;
use App\Services\RBACService\RBACServiceInterface;
use App\Services\User\UserServiceInterface;

class ResourcePolicy
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
    public function view(User $user, Resource $resource): bool
    {
        $canView = $this->RBACService->hasPermission($user, 'resource', 'view');

        return $canView;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        $canCreate = $this->RBACService->hasPermission($user, 'resource', 'create');

        return $canCreate;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Resource $resource): bool
    {
        $canUpdate = $this->RBACService->hasPermission($user, 'resource', 'update');
    
        return $canUpdate;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Resource $resource): bool
    {
        $canDelete = $this->RBACService->hasPermission($user, 'resource', 'delete');
    
        return $canDelete;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Resource $resource): bool
    {
        $canRestore = $this->RBACService->hasPermission($user, 'resource', 'restore');
    
        return $canRestore;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Resource $resource): bool
    {
        $canForceDelete = $this->RBACService->hasPermission($user, 'resource', 'forceDelete');
    
        return $canForceDelete;
    }
}
