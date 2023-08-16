<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Disease;
use App\Models\User;

class DiseasePolicy
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
        return $this->policyChecker('Disease View');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Disease $disease): bool
    {
        return $this->policyChecker('Disease View');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $this->policyChecker('Disease Create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Disease $disease): bool
    {
        return $this->policyChecker('Disease Update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Disease $disease): bool
    {
        return $this->policyChecker('Disease Delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Disease $disease): bool
    {
        return $this->policyChecker('Disease Restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Disease $disease): bool
    {
        return $this->policyChecker('Disease Force Delete');
    }
}
