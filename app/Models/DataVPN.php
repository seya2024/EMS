<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class DataVPN extends Model
{

    protected $table = 'data_v_p_n_s';



    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() // log all attributes
            ->logOnlyDirty() // optional, only log changed fields
            ->useLogName('Data_VPN'); // optional, name of the log
    }
    protected $fillable = [
        'serviceNo',
        'lANIp',
        'wanIp',
        'account',
        'branch_id',
        'media',
        'linkType',
        'vlan',
        'bandwidth',
        'remark',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
