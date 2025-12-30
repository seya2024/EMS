<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
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
