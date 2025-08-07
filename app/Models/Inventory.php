<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    //
    protected $table = 'inventory_records';

    protected $fillable = [
      'category',  
      'item_type',
      'brand_name',
      'product_type',
      'unit',
     'volumne_per_unit',
      'measurement_unit',
      'used_per_unit',
      'remaining_volume_per_unit',
      'quantity_in_stock',
      'used_unit_count',
      'status',

    ];
}
