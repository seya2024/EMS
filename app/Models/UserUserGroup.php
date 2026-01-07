<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserUserGroup extends Pivot
{
    // If your table name doesn't follow Laravel's convention, specify it:
    protected $table = 'user_user_group';


    use HasFactory, Notifiable, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() // log all attributes
            ->logOnlyDirty() // optional, only log changed fields
            ->useLogName('usergroup_pivot'); // optional, name of the log
    }


    // If you want timestamps on the pivot table
    public $timestamps = true;

    // Optional: specify fillable if needed
    protected $fillable = [
        'user_id',
        'user_group_id',
    ];
}
