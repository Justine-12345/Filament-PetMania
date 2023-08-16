<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Category;
use App\Models\User;

class CategoryPolicy
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
        return $this->policyChecker('Category View');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Category $category): bool
    {
        return $this->policyChecker('Category View');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $this->policyChecker('Category Create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Category $category): bool
    {
        return $this->policyChecker('Category Update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Category $category): bool
    {
        return $this->policyChecker('Category Delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Category $category): bool
    {
        return $this->policyChecker('Category Restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Category $category): bool
    {
        return $this->policyChecker('Category Force Delete');
    }
}
