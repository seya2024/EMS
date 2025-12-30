<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deliverable extends Model
{
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
