<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pos extends Model
{
    protected $fillable = [
        'model',
        'tag',
        'serial',
        'service_no',
        'type',
        'merchant',
        'status',
        'value',
        'quantity',
        'unit',
        // 'owner_id',
        //   'owner_type',
    ];
}
