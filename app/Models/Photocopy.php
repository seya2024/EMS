<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photocopy extends Model
{
    protected $fillable = [
        'model',
        'tag',
        'status',
        'value',
        // 'owner_id',
        //  'owner_type',
    ];
}
