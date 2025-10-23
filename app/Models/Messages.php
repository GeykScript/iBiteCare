<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    protected $table = 'messages';

    protected $fillable = [
        'patient_id',
        'immunization_sched_id',
        'schedule',
        'day_label',
        'scheduled_send_date',
        'display_message',
        'message_text',
        'sender_id',
        'status',
        'created_at',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
    public function immunizationSchedule()
    {
        return $this->belongsTo(PatientImmunizationsSchedule::class, 'immunization_sched_id');
    }
    public function sender()
    {
        return $this->belongsTo(ClinicUser::class, 'sender_id');
    }

   
}
