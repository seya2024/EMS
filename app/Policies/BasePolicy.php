<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class BasePolicy
{
    public function __construct()
    {
        //
    }

    // Standard Laravel actions
    public function viewAny(User $user, Model $model)
    {

        //return  $user->hasRole(['admin']);
        // return false;
        // return true;
        // return  $user->hasRole(['admin']);

        return $user->hasGroupPermission($model, 'viewAny');
    }


    //  if ($user->role === User::ROLE_ADMIN) return true;
    //     if ($user->role === User::ROLE_HEAD && $user->branch_id === $model->branch_id) return true;
    //     return $user->id === $model->id;
    //      return in_array($user->role, [User::ROLE_ADMIN, User::ROLE_HEAD]);

    public function view(User $user, Model $model)
    {
        return $user->hasGroupPermission($model, 'view');
    }

    public function create(User $user, Model $model)
    {
        return $user->hasGroupPermission($model, 'create');
    }

    public function update(User $user, Model $model)
    {
        return $user->hasGroupPermission($model, 'update');
    }

    public function delete(User $user, Model $model)
    {
        return $user->hasGroupPermission($model, 'delete');
    }

    public function restore(User $user, Model $model)
    {
        return $user->hasGroupPermission($model, 'restore');
    }

    public function forceDelete(User $user, Model $model)
    {
        return $user->hasGroupPermission($model, 'forceDelete');
    }

    // Optional / custom banking IT actions
    public function export(User $user, Model $model)
    {
        return $user->hasGroupPermission($model, 'export');
    }

    public function import(User $user, Model $model)
    {
        return $user->hasGroupPermission($model, 'import');
    }

    public function approve(User $user, Model $model)
    {
        return $user->hasGroupPermission($model, 'approve');
    }

    public function reject(User $user, Model $model)
    {
        return $user->hasGroupPermission($model, 'reject');
    }

    public function archive(User $user, Model $model)
    {
        return $user->hasGroupPermission($model, 'archive');
    }

    public function unarchive(User $user, Model $model)
    {
        return $user->hasGroupPermission($model, 'unarchive');
    }

    public function publish(User $user, Model $model)
    {
        return $user->hasGroupPermission($model, 'publish');
    }

    public function unpublish(User $user, Model $model)
    {
        return $user->hasGroupPermission($model, 'unpublish');
    }

    public function assign(User $user, Model $model)
    {
        return $user->hasGroupPermission($model, 'assign');
    }
}
