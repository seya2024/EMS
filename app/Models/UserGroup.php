<?php


namespace App\Models;

use App\Models\Permission;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Container\Attributes\Auth;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UserGroup extends Model
{
    use HasFactory, Notifiable, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() // log all attributes
            ->logOnlyDirty() // optional, only log changed fields
            ->useLogName('User_group'); // optional, name of the log
    }

    protected $fillable = ['name', 'description'];

    // Many-to-Many relationship with User
    // public function users()
    // {
    //     return $this->belongsToMany(User::class, 'user_user_group');
    // }


    // public function permissions(): BelongsToMany
    // {
    //     return $this->belongsToMany(Permission::class, 'group_permission');
    // }





    // public function users()
    // {
    //     return $this->belongsToMany(User::class);
    // }



    public static function getEloquentQuery()
    {
        return parent::getEloquentQuery()->where('name', '!=', 'Admin');
    }

    // public static function getEloquentQuery()
    // {
    //     return parent::getEloquentQuery()
    //         ->where('name', '!=', 'Admin')
    //         ->where('branch_id', auth()->user()->branch_id); // row-level tenancy
    // }

    //     Now, all queries automatically exclude Admin and filter by the user’s branch

    //     This is safer than trying whereBelongsTo unless you have a real relationship


    public function users()
    {
        return $this->belongsToMany(User::class, 'user_user_group', 'user_group_id', 'user_id');
    }




    // public function permissions()
    // {
    //     return $this->belongsToMany(Permission::class, 'group_permission', 'group_id', 'permission_id');
    // }



    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'group_permission');
    }

    public function hasPermission(\Illuminate\Database\Eloquent\Model $model, string $permission): bool
    {
        return $this->permissions()
            ->where('model', get_class($model))
            ->where('permission', $permission)
            ->exists();
    }




    // public function users()
    // {
    //     return $this->belongsToMany(User::class, 'user_user_group', 'user_group_id', 'user_id')
    //         ->using(UserUserGroup::class)
    //         ->withTimestamps();
    // }

    // public function users()
    // {
    //     return $this->belongsToMany(User::class, 'user_user_group')
    //         ->using(UserUserGroup::class);
    // }

    //     public function users()
    // {
    //     return $this->hasMany(User::class);
    // }
}
