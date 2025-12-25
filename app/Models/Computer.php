<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Computer extends Model
{
    use HasFactory;

    // Fillable fields for mass assignment
    protected $fillable = [
        'hardwareType',
        'pcModel',
        'tagNo',
        'serialNo',
        'harddiskSize',
        'ramSize',
        'speed',
        'os',
        'isActivated',
        'IpAddress',
        'hostName',
        'workingUnit',
        'status',
        'created_at',
        'updated_at',

    ];

    // Optional: Cast isActivated to boolean
    protected $casts = [
        'isActivated' => 'boolean',
    ];


    public function owner()
    {
        return $this->morphTo();
    }

    // public function district()
    // {
    //     return $this->belongsTo(District::class);
    // }

    // Optional: Define table name if different
    // protected $table = 'computers';

    // Optional: relationships
    // e.g., if workingUnit links to Branch
    // public function workingUnit()
    // {
    //     return $this->belongsTo(WorkingUnit::class, 'workingUnit');
    // }


    // $computer->owner; // returns HeadOffice OR DistrictOffice OR BranchOffice
}
