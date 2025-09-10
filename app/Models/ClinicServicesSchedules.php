<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClinicServicesSchedules extends Model
{
    //
    protected $table = 'services_schedules';
    protected $fillable = [
        'service_id',
        'day_offset',
        'label',
        'created_at',
        'updated_at',
    ];

    public function services (){
        return $this->belongsTo(ClinicServices::class, 'service_id');
    }
}
