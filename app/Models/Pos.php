<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pos extends Model
{
    protected $table = 'pos';

    use HasFactory, Notifiable, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() // log all attributes
            ->logOnlyDirty() // optional, only log changed fields
            ->useLogName('Pos_machine'); // optional, name of the log
    }


    protected $fillable = [
        'model',
        'tag',
        'serial',
        'service_no',
        'type',
        'merchant',
        'status',
        'value',
        'branch_id',
        // 'quantity',
        // 'unit',
        // 'owner_id',
        //   'owner_type',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
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
        return "{$this->model} | {$this->tag}";
    }
}
