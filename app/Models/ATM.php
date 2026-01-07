<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;


class ATM extends Model
{
    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() // log all attributes
            ->logOnlyDirty() // optional, only log changed fields
            ->useLogName('atm'); // optional, name of the log
    }



    protected static $logAttributes = ['*']; // log all attributes
    protected static $logName = 'ATM';
    protected static $logOnlyDirty = true; // only log changed attributes

    protected $fillable = [
        'terminal',
        'os',
        'type',
        'location',
        'design',
        'branch_id',
        'remark',
    ];


    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    // ATM has many ATMReports
    public function reports()
    {
        return $this->hasMany(ATMReport::class, 'atm_id');
    }
    public function transfers()
    {
        return $this->morphMany(AssetTransfer::class, 'asset');
    }

    public function getDisplayNameAttribute(): string
    {
        return "{$this->terminal} | {$this->type}";
    }
}
