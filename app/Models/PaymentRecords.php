<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentRecords extends Model
{
    //
    protected $table = 'payment_records';
    protected $fillable = [
        'invoice_id',
        'receipt_number',
        'amount_paid',
        'received_by_id',
        'payment_date',
        'created_at',
        'updated_at',
    ];
    public function invoice()
    {
        return $this->belongsTo(PaymentInvoice::class, 'invoice_id');
    }
}
