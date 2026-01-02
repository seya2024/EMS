<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserUserGroup extends Pivot
{
    // If your table name doesn't follow Laravel's convention, specify it:
    protected $table = 'user_user_group';

    // If you want timestamps on the pivot table
    public $timestamps = true;

    // Optional: specify fillable if needed
    protected $fillable = [
        'user_id',
        'user_group_id',
    ];
}
