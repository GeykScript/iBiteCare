<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Inventory_usage extends Model
{
    protected $table = 'inventory_usage';
    protected $fillable = [
    'item_id',
    'stock_id',
    'unit_id', 
    'used', 
    'measurement_unit', 
    'usage_date',
    'used_by',
    'details',
    'created_at',
    'updated_at'
];

    public function unit()
    {
        return $this->belongsTo(Inventory_units::class, 'unit_id');
    }
    public function clinic_user()
    {
        return $this->belongsTo(ClinicUser::class, 'used_by');
    }
    public function item()
    {
        return $this->belongsTo(Inventory_items::class, 'item_id');
    }
    public function stock()
    {
        return $this->belongsTo(Inventory_stock::class, 'stock_id');
    }

    

}
