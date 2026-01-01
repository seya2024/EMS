<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DOB extends Model
{


    protected $fillable = [
        'model',
        'service_no',
        'serial',
        'iccid',
        'network_type',
        'iccid',
        'value',
        // 'quantity',
        // 'unit',
        'status'
    ];
}
