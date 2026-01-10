<?php

namespace App\Models;

use App\Models\PCModel;
use App\Filament\Resources\Concerns\HasAssignReturnActions;
use Spatie\Activitylog\LogOptions;
use App\Models\Traits\HasAssignments;
use Illuminate\Database\Eloquent\Model;
use App\Models\PCModel as ModelsPCModel;
use App\Models\PCModel as AppModelsPCModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Computer extends Model
{



    use HasFactory, LogsActivity, HasAssignments, HasAssignReturnActions;

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



    // Computer.php (or Asset.php)
    public function assignments()
    {
        return $this->morphMany(AssetAssignment::class, 'assetable');
    }

    // Returns the active assignment (relationship)
    public function currentAssignment()
    {
        return $this->assignments()->whereNull('returned_at');
    }

    // Helper for checking if taken
    public function isTaken(): bool
    {
        return $this->currentAssignment()->exists();
    }

    // Helper for current user
    public function currentOwner()
    {
        return $this->currentAssignment()->first()?->user;
    }


    // Current assignment (optional helper)
    public function getCurrentAssignmentAttribute()
    {
        //  return $this->assignments()->whereNull('returned_at')->first();

        return $this->morphOne(AssetAssignment::class, 'assetable')
            ->whereNull('returned_at');
    }

    public function owner()
    {
        return $this->morphTo();
    }

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
