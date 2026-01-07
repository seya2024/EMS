<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class District extends Model
{

     //
    /** @use HasFactory<\Database\Factories\UserFactory> */


    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */


    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() // log all attributes
            ->logOnlyDirty() // optional, only log changed fields
            ->useLogName('District'); // optional, name of the log
    }

    protected $fillable = [
        'id',
        'name',
        'director',
        'created_at',
        'updated_at',
    ];



    //
    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    public function getFilamentName(): string
    {
        return "{$this->name}";
    }

    public function computers()
    {
        return $this->morphMany(Computer::class, 'owner');
    }


    public function activityReports()
    {
        return $this->hasMany(ActivityReport::class);
    }
}
