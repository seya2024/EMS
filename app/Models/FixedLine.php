<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FixedLine extends Model
{
    use HasFactory;

    protected $fillable = [
        'serviceNo',
        'account',
        'branch',
        'media',
        'remark',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
