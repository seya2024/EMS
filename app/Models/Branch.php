<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Branch extends Model
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
        'code',
        'name',
        'grade',
        'district_id',
        'created_at',
        'updated_at',
        'tag',

    ];



    public function outlets()
    {
        return $this->hasMany(Outlet::class);
    }
    public function getFilamentName(): string
    {
        return "{$this->name}";
    }

    public function atms()
    {
        return $this->hasMany(ATM::class);
    }

    public function fixedLines()
    {
        return $this->hasMany(FixedLine::class, 'branch_id');
    }



    public function computers()
    {
        return $this->hasMany(Computer::class);
    }

    public function otherAssets()
    {
        return $this->hasMany(OtherAsset::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    // Branch.php
    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
