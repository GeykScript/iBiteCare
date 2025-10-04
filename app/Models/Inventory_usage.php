<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Inventory_usage extends Model
{
    protected $table = 'inventory_usage';
    protected $fillable = [
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
    // 🔗 Shortcut relation to get the item directly
    public function item()
    {
        return $this->hasOneThrough(
            Inventory_items::class,
            Inventory_units::class,
            'id',               // Foreign key on inventory_units
            'id',               // Foreign key on inventory_items
            'unit_id',          // Local key on inventory_usage
            'item_id' // Local key on inventory_units
        );
    }
    

}
