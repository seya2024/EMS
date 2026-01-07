<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class ComputerModel extends Model
{
    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() // log all attributes
            ->logOnlyDirty() // optional, only log changed fields
            ->useLogName('Computer Model'); // optional, name of the log
    }

    protected $table = 'computer_models'; // be explicit if table name matters

    protected $fillable = [
        'name',
        'description',
        'created_at',
        'updated_at',

    ];
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime'
        ];
    }


    // One PCModel has many computers
    public function computers()
    {
        return $this->hasMany(Computer::class);
    }

    public function hardwareType()
    {
        return $this->belongsTo(HardwareType::class);
    }
}
