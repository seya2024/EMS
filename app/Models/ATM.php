<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ATM extends Model
{
    use HasFactory;

    protected $fillable = [
        'terminal',
        'os',
        'type',
        'location',
        'design',
        'custodian',
        'remark',
    ];


    public function branch()
    {
        return $this->belongsTo(Branch::class, 'custodian');
    }
}
