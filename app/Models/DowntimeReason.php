<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DowntimeReason extends Model
{
    //

    use HasFactory;

    protected $fillable = [
        'name',
        'responsible',

    ];


    public function atmReports()
    {
        return $this->hasMany(ATMReport::class, 'downtime_reason_id');
    }
}
