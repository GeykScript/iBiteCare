<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory_items extends Model
{
    //
    protected $table = 'inventory_items';
    protected $fillable = [
         'category', 
         'brand_name', 
         'product_type',
         'immunity_type',
         'stock_status',
         'service',
         'last_restocked_date',
         'created_at',
         'updated_at'
        ];
}
