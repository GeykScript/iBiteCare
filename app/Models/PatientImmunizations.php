<?php

namespace App\Models;

use App\Livewire\InventoryItems;
use Illuminate\Database\Eloquent\Model;

class PatientImmunizations extends Model
{
    //
    protected $table = 'patient_immunizations';
    protected $fillable = [
        'patient_id',
        'transaction_id',
        'service_id',
        'exposure_id',
        'vital_signs_id',
        'immunization_type',
        'scheduled_date',
        'date_given',
        'day_label',
        'vaccine_used_id',
        'rig_used_id',
        'anti_tetanus_id',
        'route_of_administration',
        'patient_outcome',
        'administered_by_id',
        'invoice_id',
        'schedule_id',
        'status',
        'created_at',
        'modified_at',
    ];
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function transaction()
    {
        return $this->belongsTo(ClinicTransactions::class, 'transaction_id');
    }

    public function service()
    {
        return $this->belongsTo(ClinicServices::class, 'service_id');
    }
    public function exposure()
    {
        return $this->belongsTo(PatientExposures::class, 'exposure_id');
    }
    public function vitalSigns()
    {
        return $this->belongsTo(PatientVitalSigns::class, 'vital_signs_id');
    }
    public function vaccineUsed()
    {
        return $this->belongsTo(Inventory_units::class, 'vaccine_used_id');
    }
    public function rigUsed()
    {
        return $this->belongsTo(Inventory_units::class, 'rig_used_id');
    }
    public function antiTetanusUsed()
    {
        return $this->belongsTo(Inventory_units::class, 'anti_tetanus_id');
    }

    public function administeredBy()
    {
        return $this->belongsTo(ClinicUser::class, 'administered_by_id');
    }

    public function invoice()
    {
        return $this->belongsTo(PaymentInvoice::class, 'invoice_id');
    }
    public function schedule()
    {
        return $this->belongsTo(ClinicServicesSchedules::class, 'schedule_id');
    }

}
