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
    // ATM has many ATMReports
    public function reports()
    {
        return $this->hasMany(ATMReport::class, 'atm_id');
    }
}
