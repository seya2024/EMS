<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Admin and branch-head can view user list
        return in_array($user->role, [User::ROLE_ADMIN, User::ROLE_HEAD]);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        // Admin can view anyone
        // Head can view users in the same branch
        // Others only themselves
        if ($user->role === User::ROLE_ADMIN) return true;
        if ($user->role === User::ROLE_HEAD && $user->branch_id === $model->branch_id) return true;
        return $user->id === $model->id;
    }

    /**
     * Determine whether the user can create models.
     */

    public function create(User $user): bool
    {
        // Only Admin and Head can create users
        return in_array($user->role, [User::ROLE_ADMIN, User::ROLE_HEAD]);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        // Admin can update anyone
        // Head can update users in the same branch
        // Others only themselves
        if ($user->role === User::ROLE_ADMIN) return true;
        if ($user->role === User::ROLE_HEAD && $user->branch_id === $model->branch_id) return true;
        return $user->id === $model->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        // Only Admin can delete users
        return $user->role === User::ROLE_ADMIN;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return $user->role === User::ROLE_ADMIN;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return $user->role === User::ROLE_ADMIN;
    }

    // public function viewAny(User $user): bool
    //     {
    //         // Admin and branch-head can view user list
    //         return in_array($user->role, [User::ROLE_ADMIN, User::ROLE_HEAD]);
    //     }

    //     public function view(User $user, User $model): bool
    //     {
    //         // Admin can view anyone
    //         // Head can view users in the same branch
    //         // Others only themselves
    //         if ($user->role === User::ROLE_ADMIN) return true;
    //         if ($user->role === User::ROLE_HEAD && $user->branch_id === $model->branch_id) return true;
    //         return $user->id === $model->id;
    //     }

    //     public function create(User $user): bool
    //     {
    //         // Only Admin and Head can create users
    //         return in_array($user->role, [User::ROLE_ADMIN, User::ROLE_HEAD]);
    //     }

    //     public function update(User $user, User $model): bool
    //     {
    //         // Admin can update anyone
    //         // Head can update users in the same branch
    //         // Others only themselves
    //         if ($user->role === User::ROLE_ADMIN) return true;
    //         if ($user->role === User::ROLE_HEAD && $user->branch_id === $model->branch_id) return true;
    //         return $user->id === $model->id;
    //     }

    //     public function delete(User $user, User $model): bool
    //     {
    //         // Only Admin can delete users
    //         return $user->role === User::ROLE_ADMIN;
    //     }

    //     public function restore(User $user, User $model): bool
    //     {
    //         return $user->role === User::ROLE_ADMIN;
    //     }

    //     public function forceDelete(User $user, User $model): bool
    //     {
    //         return $user->role === User::ROLE_ADMIN;
    //     }


}
