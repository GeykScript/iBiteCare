<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientExposures extends Model
{
    //
    protected $table = 'patient_exposures';
    protected $fillable = [
        'patient_id',
        'transaction_id',
        'date_time',
        'place_of_bite',
        'type_of_exposure',
        'site_of_bite',
        'bite_category',
        'bite_management',
        'animal_profile_id',
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

    public function animalProfile(){
        return $this->belongsTo(AnimalProfile::class, 'animal_profile_id');
    }
}
