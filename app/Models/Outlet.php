<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Outlet extends Model
{


      //
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $fillable = [
        'id',
        'name',
        'branch_id',
        'created_at',
        'updated_at',
    ];
    //
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
