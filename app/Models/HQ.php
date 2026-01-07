<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class HQ extends Model
{
    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() // log all attributes
            ->logOnlyDirty() // optional, only log changed fields
            ->useLogName('Head office'); // optional, name of the log
    }

    protected $table = 'h_q_s'; // be explicit if table name matters

    protected $fillable = [
        'name',
        'slogan',
    ];

    // timestamps are enabled by default
    public $timestamps = true;

    public function computers()
    {
        return $this->morphMany(Computer::class, 'owner');
    }

    // public function districts()
    // {
    //     return $this->hasMany(District::class);
    // }
}
