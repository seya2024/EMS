<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HQ extends Model
{
    use HasFactory;

    protected $table = 'h_q_s'; // be explicit if table name matters

    protected $fillable = [
        'name',
        'slogan',
    ];

    // timestamps are enabled by default
    public $timestamps = true;

    public function computers()
    {
        return $this->morphMany(Computer::class, 'owner');
    }

    // public function districts()
    // {
    //     return $this->hasMany(District::class);
    // }
}
