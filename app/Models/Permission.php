<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    protected $fillable = ['name', 'model', 'action'];


    use HasFactory, Notifiable, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() // log all attributes
            ->logOnlyDirty() // optional, only log changed fields
            ->useLogName('permission'); // optional, name of the log
    }


    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(
            UserGroup::class,
            'group_permission', // pivot table
            'permission_id',    // FK for this model in pivot
            'group_id'     // FK for related model in pivot
        );
    }
}
