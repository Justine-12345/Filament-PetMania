<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Animal;
use App\Models\User;

class AnimalPolicy
{
    /**
     * Determine whether the user can view any models.
     */

     private function policyChecker($action):bool{
        $userPermissions = auth()->user()->role->permissions->pluck('name','id')->toArray();
       return in_array($action, $userPermissions);
     }



    public function viewAny(User $user): bool
    {
       
        return $this->policyChecker('Animal View');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Animal $animal): bool
    {
        //
        return $this->policyChecker('Animal View');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        return $this->policyChecker('Animal Create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Animal $animal): bool
    {
        //
        return $this->policyChecker('Animal Update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Animal $animal): bool
    {
        //
        return $this->policyChecker('Animal Delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Animal $animal): bool
    {
        //
        return $this->policyChecker('Animal Restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Animal $animal): bool
    {
        //
        return $this->policyChecker('Animal Force Delete');
    }
}
