<?php

namespace App\Models;

use App\Models\PCModel;
use App\Models\PCModel as ModelsPCModel;
use App\Models\PCModel as AppModelsPCModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Computer extends Model
{



    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() // log all attributes
            ->logOnlyDirty() // optional, only log changed fields
            ->useLogName('Computer'); // optional, name of the log
    }

    // Fillable fields for mass assignment
    protected $fillable = [

        'hardware_type_id',
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

    public function hardwareType()
    {
        return $this->belongsTo(HardwareType::class);
    }


    public function computerModel()
    {

        return $this->belongsTo(ComputerModel::class);
    }



    public function model(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ComputerModel::class, 'computer_model_id');
    }

    public function getDisplayNameAttribute(): string
    {
        return "{$this->model->name} | {$this->tagNo}";
    }

    public function maintenances()
    {
        return $this->morphMany(AssetMaintenance::class, 'assetable');
    }

    public function transfers()
    {
        return $this->morphMany(AssetTransfer::class, 'assetable');
    }

    // $computer->owner; // returns HeadOffice OR DistrictOffice OR BranchOffice
}
