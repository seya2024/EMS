<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class District extends Model
{

     //
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */


    protected $fillable = [
        'id',
        'name',
        'director',
        'created_at',
        'updated_at',
    ];



    //
    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    public function getFilamentName(): string
    {
        return "{$this->name}";
    }

    public function computers()
    {
        return $this->morphMany(Computer::class, 'owner');
    }


    public function activityReports()
    {
        return $this->hasMany(ActivityReport::class);
    }
}
