<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HardwareType extends Model
{
    use HasFactory;

    protected $table = 'hardware_types';

    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * One HardwareType has many HardwareModels
     */
    public function hardwareModels()
    {
        return $this->hasMany(ComputerModel::class);
    }
}
