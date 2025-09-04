<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentInvoice extends Model
{
    //
    protected $table = 'payment_invoices';
    protected $fillable = [
        'patient_id',
        'transaction_id',
        'invoice_number',
        'total_amount',
        'status',
        'issued_by_id',
        'invoice_date',
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

    public function issuedBy()
    {
        return $this->belongsTo(ClinicUser::class, 'issued_by_id');
    }
}
