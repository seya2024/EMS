<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OU extends Model
{


    protected $fillable = [
        'id',
        'name',
        'description',
        'created_at',
        'updated_at',
    ];

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    public function activityReports()
    {
        return $this->hasMany(ActivityReport::class, 'task_giver_id');
    }
}
