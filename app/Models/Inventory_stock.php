<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory_stock extends Model
{
    protected $table = 'inventory_stocks';
    protected $fillable = [
        'item_id',
        'package_type',
        'packages_received',
        'items_per_package',
        'unit_type',
        'total_units',
        'total_remaining_units',
        'total_package_amount',
        'restock_date',
        'supplier',
        'created_at',
        'updated_at'
    ];

    public function item()
    {
        return $this->belongsTo(Inventory_items::class, 'item_id');
    }

}
