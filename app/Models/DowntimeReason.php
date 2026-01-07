<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class DowntimeReason extends Model
{
    //

    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() // log all attributes
            ->logOnlyDirty() // optional, only log changed fields
            ->useLogName('downtime_reason'); // optional, name of the log
    }

    protected $fillable = [
        'name',
        'responsible',

    ];


    public function atmReports()
    {
        return $this->hasMany(ATMReport::class, 'downtime_reason_id');
    }
}
