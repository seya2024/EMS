<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OU extends Model
{

    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() // log all attributes
            ->logOnlyDirty() // optional, only log changed fields
            ->useLogName('Organizational_unit'); // optional, name of the log
    }

    protected $fillable = [
        'id',
        'name',
        'description',
        'created_at',
        'updated_at',
    ];

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    public function activityReports()
    {
        return $this->hasMany(ActivityReport::class);
    }


    public function assetMaintenances()
    {
        return $this->hasMany(AssetMaintenance::class);
    }
}
