<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientPrevAntiRabies extends Model
{
    //
    protected $table = 'patient_previous_anti_rabies';

    protected $fillable = [
        'patient_id',
        'immunization_type',
        'place_of_immunization',
        'date_dose_given',
        'created_at',
        'updated_at',
    ];
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
