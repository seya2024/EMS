<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataVPN extends Model
{
    use HasFactory;

    protected $fillable = [
        'serviceNo',
        'lANIp',
        'wanIp',
        'account',
        'branch',
        'media',
        'linkType',
        'vlan',
        'remark',
    ];
}
