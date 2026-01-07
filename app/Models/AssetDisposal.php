<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssetDisposal extends Model
{


    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() // log all attributes
            ->logOnlyDirty() // optional, only log changed fields
            ->useLogName('asset_disposal'); // optional, name of the log
    }

    protected $fillable = [
        'asset_type',
        'asset_id',
        'branch_id',
        'disposed_by',
        'disposed_at',
        'reason',
    ];

    public function asset()
    {
        return $this->morphTo();
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'disposed_by');
    }
}
