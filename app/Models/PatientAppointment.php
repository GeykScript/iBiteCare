<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientAppointment extends Model
{
    use HasFactory;

    protected $table = 'patient_appointments';

    protected $fillable = [
        'booking_reference',
        'patient_account_id',
        'name',
        'contact_number',
        'email',
        'treatment_type',
        'appointment_date',
        'appointment_time',
        'additional_notes',
        'booking_channel',
        'status',
        'handled_by_id',
    ];

    protected $casts = [
        'appointment_date' => 'date',
    ];
}