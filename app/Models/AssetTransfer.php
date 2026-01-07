<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssetTransfer extends Model
{


    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() // log all attributes
            ->logOnlyDirty() // optional, only log changed fields
            ->useLogName('asset_transfer'); // optional, name of the log
    }


    protected static $logAttributes = ['*']; // log all attributes
    protected static $logName = 'asset_transfer';
    protected static $logOnlyDirty = true; // only log changed attributes


    protected $fillable = [
        'assetable_type',
        'assetable_id',
        'from_branch_id',
        'to_branch_id',
        'action',
        'performed_by',
        'performed_at',
        'remarks',
    ];

    protected $casts = [
        'performed_at' => 'datetime',
    ];


    public function assetable(): MorphTo
    {
        return $this->morphTo();
    }

    /* ================= Branch Relations ================= */
    public function fromBranch()
    {
        return $this->belongsTo(Branch::class, 'from_branch_id');
    }

    public function toBranch()
    {
        return $this->belongsTo(Branch::class, 'to_branch_id');
    }

    /* ================= User ================= */
    public function user()
    {
        return $this->belongsTo(User::class, 'performed_by');
    }
}
