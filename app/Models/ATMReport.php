<?php

namespace App\Models;

use App\Models\ATM;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ATMReport extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'custodian',
        'action_taken',
        'down_time_in_days',
        'open_date',
        'close_date',
        'call_ID',
        'TT',
        'atm_id',
        'downtime_reason_id',
        'created_by', // include in fillable if needed
        'closed_by'
    ];


    protected $casts = [
        'close_date' => 'datetime',
    ];

    // Automatically set created_by to current user
    protected static function booted()
    {
        static::creating(function ($model) {
            if (Auth::check()) {
                $model->created_by = Auth::id();
            }
        });
    }
    // ATMReport belongs to an ATM
    public function atm()
    {
        return $this->belongsTo(ATM::class, 'atm_id');
    }



    public function downtimeReason()
    {
        return $this->belongsTo(DowntimeReason::class);
        //  return $this->belongsTo(DowntimeReason::class, 'downtime_reason_id', 'id');
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'custodian'); // 'custodian' is the foreign key in ATMReport
    }

    // Relation to the user who created the record
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function closer()
    {
        return $this->belongsTo(User::class, 'closed_by');
    }
}
