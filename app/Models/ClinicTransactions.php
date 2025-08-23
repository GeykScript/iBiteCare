<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ClinicTransactions extends Model
{
    protected $table = 'patient_transactions';
    protected $fillable = [
        'patient_id',
        'service_id',
        'transaction_date',
    ];

    public function Patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }
    public function Service()
    {
        return $this->belongsTo(ClinicServices::class, 'service_id', 'id');
    }


    public function getDateOnlyAttribute()
    {
        return Carbon::parse($this->transaction_date)->format('Y-m-d');
    }

    public function getTimeOnlyAttribute()
    {
        return Carbon::parse($this->transaction_date)->format('H:i');
    }

    public function getDateTimeAttribute()
    {
        return Carbon::parse($this->transaction_date)->format('Y-m-d H:i');
    }

}