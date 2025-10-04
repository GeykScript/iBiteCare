<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientPrevAntiTetanus extends Model
{
    //
    protected $table = 'patient_previous_anti_tetanus';

    protected $fillable = [
        'patient_id',
        'dose_brand',
        'dose_given',
        'rn_in_charge',
        'date_dose_given',
        'year_last_dose_given',
        'created_at',
        'updated_at',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
    public function nurse()
    {
        return $this->belongsTo(ClinicUser::class, 'rn_in_charge');
    }
}
