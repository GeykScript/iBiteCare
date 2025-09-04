<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientVitalSigns extends Model
{
    //
    protected $table = 'patient_vital_signs';
    protected $fillable = [
        'patient_id',
        'transaction_id',
        'recorded_date',
        'temperature',
        'blood_pressure',
        'weight',
        'created_at',
        'updated_at',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function transaction()
    {
        return $this->belongsTo(ClinicTransactions::class, 'transaction_id');
    }
}
