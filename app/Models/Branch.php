<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;


class Branch extends Model
{
    //
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */




    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() // log all attributes
            ->logOnlyDirty() // optional, only log changed fields
            ->useLogName('Branch'); // optional, name of the log
    }

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
        return $this->hasMany(FixedLine::class);
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

    public function dataVpns()
    {
        return $this->hasMany(DataVPN::class);
    }

    public function dongles()
    {
        return $this->hasMany(Dongle::class);
    }

    public function dobs()
    {
        return $this->hasMany(DOB::class);
    }

    public function photocopies()
    {
        return $this->hasMany(Photocopy::class);
    }

    public function posDevices()
    {
        return $this->hasMany(Pos::class);
    }

    public function printers()
    {
        return $this->hasMany(Printer::class);
    }

    public function scanners()
    {
        return $this->hasMany(Scanner::class);
    }

    public function assetMaintenances()
    {
        return $this->hasMany(AssetMaintenance::class);
    }
}
