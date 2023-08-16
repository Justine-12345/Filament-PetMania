<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Permission;
use App\Models\User;

class PermissionPolicy
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
        return $this->policyChecker('Permission View');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Permission $permission): bool
    {
        return $this->policyChecker('Permission View');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $this->policyChecker('Permission Create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Permission $permission): bool
    {
        return $this->policyChecker('Permission Update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Permission $permission): bool
    {
        return $this->policyChecker('Permission Delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Permission $permission): bool
    {
        return $this->policyChecker('Permission Restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Permission $permission): bool
    {
        return $this->policyChecker('Permission Force Delete');
    }
}
