<?php
// app/Models/Traits/HasAssignments.php

namespace App\Models\Traits;

use App\Models\AssetAssignment;

trait HasAssignments
{
    public function assignments()
    {
        return $this->morphMany(AssetAssignment::class, 'assetable');
    }

    public function currentAssignment()
    {
        return $this->morphOne(AssetAssignment::class, 'assetable')
            ->whereNull('returned_at');
    }

    public function currentOwner()
    {
        return optional($this->currentAssignment)->user;
    }
}
