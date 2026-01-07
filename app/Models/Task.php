<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{

    use HasFactory, Notifiable, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() // log all attributes
            ->logOnlyDirty() // optional, only log changed fields
            ->useLogName('Task_activity'); // optional, name of the log
    }
    protected $fillable = [
        'task_category_id',
        'name',
        'description',
    ];

    // public function category()
    // {
    //     return $this->belongsTo(TaskCategory::class, 'task_category_id');
    // }

    public function deliverables()
    {
        return $this->hasMany(Deliverable::class);
    }

    public function taskCategory()
    {
        return $this->belongsTo(TaskCategory::class);
    }
}
