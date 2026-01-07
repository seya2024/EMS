<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class OtherAsset extends Model
{
    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() // log all attributes
            ->logOnlyDirty() // optional, only log changed fields
            ->useLogName('Non_digital_fixed_asset'); // optional, name of the log
    }

    protected $fillable = [
        'asset_class_id',
        'asset_number',
        'description',
        'cost_center',
        'branch_id',
        'asset_cost',
        'depreciation_current_year',
        'assigned_to',
    ];

    public function assetClass()
    {
        return $this->belongsTo(AssetClass::class);
    }

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
        return "{$this->asset_number} | {$this->description}";
    }
}
