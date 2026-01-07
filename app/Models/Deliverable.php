<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Deliverable extends Model
{


    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() // log all attributes
            ->logOnlyDirty() // optional, only log changed fields
            ->useLogName('Deliverable'); // optional, name of the log
    }


    protected $fillable = [
        'task_id',
        'outcome',
        'description',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
