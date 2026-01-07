<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetMaintenance extends Model
{
    //
    protected $fillable = [
        'assetable_id',     // Polymorphic ID
        'assetable_type',   // Polymorphic type
        'branch_id',        // Branch where asset belongs
        'ou_id',          // Organizational / support unit
        'problem',          // Description of the issue
        'sent_date',        // Date maintenance was sent
        'return_date',      // Optional return date
        'status',           // SENT, RECEIVED, IN_PROGRESS, CLOSED
        'user_id',
        'approval_status', // added       // User who created the request
    ];



    protected $casts = [
        'sent_date' => 'date',
        'return_date' => 'date',
    ];


    public function isApproved(): bool
    {
        return $this->approval_status === 'ACCEPTED';
    }

    public function assetable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function ou()
    {
        return $this->belongsTo(OU::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
