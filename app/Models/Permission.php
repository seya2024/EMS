<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    protected $fillable = ['name', 'model', 'action'];

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
