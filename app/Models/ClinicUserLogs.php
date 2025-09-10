<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClinicUserLogs extends Model
{
    protected $table = 'user_logs';

    protected $fillable = [
        'user_id',
        'role_id',
        'action',
        'details',
        'date_and_time'
    ];

    public function clinic_user()
    {
        return $this->belongsTo(ClinicUser::class, 'user_id');
    }

    public function role()
    {
        return $this->belongsTo(ClinicUserRole::class, 'role_id');
    }

}
