<?php

namespace App\Policies;

use App\Models\Pcelinjak;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PcelinjakPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    // public function viewAny(User $user): bool
    // {
    //     return true;
    // }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Pcelinjak $pcelinjak): bool
    {
        return $pcelinjak->user_id === $user->id;
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
    public function update(User $user, Pcelinjak $pcelinjak): bool
    {
        return $pcelinjak->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Pcelinjak $pcelinjak): bool
    {
        return $pcelinjak->user_id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    // public function restore(User $user, Pcelinjak $pcelinjak): bool
    // {
    //     return false;
    // }

    /**
     * Determine whether the user can permanently delete the model.
     */
    // public function forceDelete(User $user, Pcelinjak $pcelinjak): bool
    // {
    //     return false;
    // }
}
