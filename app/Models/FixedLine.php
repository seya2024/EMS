<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class FixedLine extends Model
{
    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() // log all attributes
            ->logOnlyDirty() // optional, only log changed fields
            ->useLogName('Fixed_line'); // optional, name of the log
    }

    protected $fillable = [
        'serviceNo',
        'account',
        'branch_id',
        'media',
        'remark',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
