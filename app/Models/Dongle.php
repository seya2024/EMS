<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dongle extends Model
{
    protected $fillable = [
        'model',
        'serial',
        'imei',
        'iccid',
        'service_no',
        'network_type',
        'value',
        'status',
        // 'quantity',
        // 'unit',
        // 'owner_id',
        // 'owner_type',
    ];
}
