<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class DOB extends Model
{


    protected $table = 'd_o_b_s';


    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() // log all attributes
            ->logOnlyDirty() // optional, only log changed fields
            ->useLogName('DOB'); // optional, name of the log
    }

    protected $fillable = [
        'model',
        'service_no',
        'serial',
        'iccid',
        'network_type',
        'iccid',
        'value',
        'branch_id',
        // 'quantity',
        // 'unit',
        'status'
    ];
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function maintenances()
    {
        return $this->morphMany(AssetMaintenance::class, 'assetable');
    }

    public function transfers()
    {
        return $this->morphMany(AssetTransfer::class, 'assetable');
    }

    public function getDisplayNameAttribute(): string
    {
        return "{$this->model} | {$this->serial}";
    }
}
