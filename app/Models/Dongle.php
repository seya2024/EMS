<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dongle extends Model
{

    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() // log all attributes
            ->logOnlyDirty() // optional, only log changed fields
            ->useLogName('Dongle'); // optional, name of the log
    }
    protected $fillable = [
        'model',
        'serial',
        'imei',
        'iccid',
        'service_no',
        'network_type',
        'value',
        'status',
        'branch_id',
        // 'quantity',
        // 'unit',
        // 'owner_id',
        // 'owner_type',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function transfers()
    {
        return $this->morphMany(AssetTransfer::class, 'assetable');
    }
    public function maintenances()
    {
        return $this->morphMany(AssetMaintenance::class, 'assetable');
    }

    public function getDisplayNameAttribute(): string
    {
        return "{$this->model} | {$this->imei} | {$this->service_no}";
    }
}
