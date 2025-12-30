<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    // Many-to-Many relationship with User
    // public function users()
    // {
    //     return $this->belongsToMany(User::class, 'user_user_group');
    // }


    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    //     public function users()
    // {
    //     return $this->hasMany(User::class);
    // }
}
