<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scanner extends Model
{
    protected $fillable = [
        'model',
        'tag',
        'status',
        'value',
        'quantity',
        'unit',
        //  'owner_id',
        //   'owner_type',
    ];
}
