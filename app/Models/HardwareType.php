<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class HardwareType extends Model
{
    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() // log all attributes
            ->logOnlyDirty() // optional, only log changed fields
            ->useLogName('hardware_type'); // optional, name of the log
    }

    protected $table = 'hardware_types';

    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * One HardwareType has many HardwareModels
     */
    public function hardwareModels()
    {
        return $this->hasMany(ComputerModel::class);
    }

    public function computers()
    {
        return $this->hasMany(Computer::class);
    }
}
