<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\User;
use App\Services\RBAC\RBACServiceInterface;
use App\Services\User\UserServiceInterface;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class BookingPolicy
{
    public function __construct(private UserServiceInterface $userService,
        private RBACServiceInterface $RBACService)
    {}
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        $canView = $this->RBACService->hasPermission($user, 'booking', 'viewAll');

        $userRoles = $user->roles()->get();

        if ($userRoles->where('name', 'client')->isNotEmpty())
        {
            return false;
        }

        return $canView;
    }

    public function viewAnyForUser(User $user): bool
    {
        $canView = $this->RBACService->hasPermission($user, 'booking', 'viewAllForUser');
        
        return $canView;
    }


    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Booking $booking): bool
    {
        $canView = $this->RBACService->hasPermission($user, 'booking', 'view');

        $userRoles = $user->roles()->get();

        if ($userRoles->where('name', 'client')->isNotEmpty())
        {
            return $canView && $user->id == $booking->user_id;
        }

        return $canView;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }

    public function cancel(User $user, Booking $booking): bool
    {
        $canCancel = $this->RBACService->hasPermission($user, 'booking', 'cancel');

        $userRoles = $user->roles()->get();

        if ($userRoles->where('name', 'client')->isNotEmpty())
        {
            return $canCancel && $user->id == $booking->user_id;
        }

        return $canCancel;
    }
}
