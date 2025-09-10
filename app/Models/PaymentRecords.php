<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentRecords extends Model
{
    //
    protected $table = 'payment_records';
    protected $fillable = [
        'patient_id',
        'transaction_id',
        'invoice_id',
        'receipt_number',
        'amount_paid',
        'received_by_id',
        'payment_date',
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
    public function invoice()
    {
        return $this->belongsTo(PaymentInvoice::class, 'invoice_id');
    }
    public function receivedBy()
    {
        return $this->belongsTo(ClinicUser::class, 'received_by_id');
    }
}
