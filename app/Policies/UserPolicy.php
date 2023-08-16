<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */

     private function policyChecker($action): bool
    {
        $userPermissions = auth()->user()->role->permissions->pluck('name', 'id')->toArray();
        return in_array($action, $userPermissions);
    }

    public function viewAny(User $user): bool
    {
         return $this->policyChecker('User View');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return $this->policyChecker('User View');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $this->policyChecker('User Create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return $this->policyChecker('User Update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return $this->policyChecker('User Delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return $this->policyChecker('User Restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return $this->policyChecker('User Force Delete');
    }
}
