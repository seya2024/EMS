<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityReport extends Model
{


    protected $fillable = [
        'task_id',
        'deliverable_id',
        'task_giver_id',   // FK to ou.id
        'district_id',
        'status',
        'description',
        'report_date',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function deliverable()
    {
        return $this->belongsTo(Deliverable::class);
    }

    public function taskGiver()
    {
        return $this->belongsTo(Ou::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
