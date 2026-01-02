<?php


namespace App\Models;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UserGroup extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    // Many-to-Many relationship with User
    // public function users()
    // {
    //     return $this->belongsToMany(User::class, 'user_user_group');
    // }


    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'group_permission');
    }

    // public function users()
    // {
    //     return $this->belongsToMany(User::class);
    // }


    public function users()
    {
        return $this->belongsToMany(User::class, 'user_user_group', 'user_group_id', 'user_id');
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
