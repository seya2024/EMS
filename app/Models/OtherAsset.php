<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherAsset extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_class_id',
        'asset_number',
        'description',
        'cost_center',
        'branch_id',
        'asset_cost',
        'depreciation_current_year',
        'assigned_to',
    ];

    public function assetClass()
    {
        return $this->belongsTo(AssetClass::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
