<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ComputerModel extends Model
{
    use HasFactory;

    protected $table = 'computer_models'; // be explicit if table name matters

    protected $fillable = [
        'name',
        'description',
        'created_at',
        'updated_at',

    ];
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime'
        ];
    }


    // One PCModel has many computers
    public function computers()
    {
        return $this->hasMany(Computer::class);
    }

    public function hardwareType()
    {
        return $this->belongsTo(HardwareType::class);
    }
}
