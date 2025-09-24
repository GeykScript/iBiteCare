<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientImmunizationsSchedule extends Model
{
    //
    protected $table = 'patient_immunization_schedule';
    protected $fillable = [
        'transaction_id',
        'patient_id',
        'service_id',
        'service_sched_id',
        'Day',
        'schedule_date',
        'date_completed',
        'status',
        'dose',
        'administered_by',
        'grouping',
        'created_at',
        'updated_at',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function service()
    {
        return $this->belongsTo(ClinicServices::class, 'service_id');
    }
    public function transaction()
    {
        return $this->belongsTo(ClinicTransactions::class, 'transaction_id');
    }
    public function serviceSchedule()
    {
        return $this->belongsTo(ClinicServicesSchedules::class, 'service_sched_id');
    }
    public function nurse()
    {
        return $this->belongsTo(ClinicUser::class, 'administered_by', 'id');
    }

}
