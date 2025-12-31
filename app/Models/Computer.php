<?php

namespace App\Models;

use App\Models\PCModel;
use App\Models\PCModel as ModelsPCModel;
use App\Models\PCModel as AppModelsPCModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Computer extends Model
{
    use HasFactory;

    // Fillable fields for mass assignment
    protected $fillable = [

        'hardwareType',
        // 'pcModel',
        'computer_model_id', // foreign key
        'tagNo',
        'serialNo',
        'harddiskSize',
        'ramSize',
        'speed',
        'isActiveAntivirus',
        'os',
        'isActivated',
        'IpAddress',
        'hostName',
        'status',
        'branch_id',
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
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function computerModel()
    {

        return $this->belongsTo(ComputerModel::class);
    }

    // $computer->owner; // returns HeadOffice OR DistrictOffice OR BranchOffice
}
