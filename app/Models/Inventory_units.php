<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory_units extends Model
{
    //
    protected $table = 'inventory_units';
    protected $fillable = [
        'item_id',
        'stock_id',
        'package_number',
        'unit_number',
        'measurement_unit',
        'unit_volume',
        'remaining_volume',
        'unit_quantity',
        'remaining_quantity',
        'status',
        'created_at',
        'updated_at'
    ];

    public function item()
    {
        return $this->belongsTo(Inventory_items::class, 'item_id');
    }

    public function stock()
    {
        return $this->belongsTo(Inventory_stock::class, 'stock_id');
    }
}
