<?php

namespace App\Http\Controllers\ClinicUser;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Inventory_items;
use App\Models\Inventory_stock;
use App\Models\Inventory_units;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventorySupplies extends Controller
{
    //
    public function index(){

        $clinicUser = Auth::user();
        return view('ClinicUser.supplies', compact('clinicUser'));
    }

    public function add_new_supplies(Request $request){

        $request->validate([
            'category' => 'required|string|max:255',
            'brand_name' => 'required|string|max:255',
            'product_type' => 'required|string|max:255',
            'immunity_type' => 'nullable|string|max:255',
            'package_type' => 'required|string|max:255',
            'packages_received' => 'required|integer|min:1',
            'items_per_package' => 'required|integer|min:1',
            'volume_per_item' => 'nullable|numeric|min:0',
            'price_per_item' => 'required|numeric|min:0',
            'total_price' => 'required|numeric|min:0',
            'supplier' => 'required|string|max:255',

        ]);

        $item = Inventory_items::create([
            'category' => $request->category,
            'brand_name' => $request->brand_name,
            'product_type' => $request->product_type,
            'immunity_type' => $request->immunity_type,
            'stock_status' => 'In Stock',
            'last_restocked_date' => now(),
        ]);

            $total_units = $request->packages_received * $request->items_per_package;
        

        $stock = Inventory_stock::create([
            'item_id' => $item->id,
            'package_type' => $request->package_type,
            'packages_received' => $request->packages_received,
            'items_per_package' => $request->items_per_package,
            'unit_type' => "pcs",
            'total_units' => $total_units,
            'total_remaining_units' => $total_units,
            'total_package_amount' => $request->total_price,
            'restock_date' => now(),
            'supplier' => $request->supplier,
        ]);

        if (strtolower($request->category) === 'supply' || strtolower($request->category) === 'equipment' ) {
            // ✅ For supply: just one row
            Inventory_units::create([
                'item_id' => $item->id,
                'stock_id' => $stock->id,       
                'package_number' =>  Inventory_units::where('item_id', $item->id)->max('package_number') + 1,
                'unit_number' => 1,
                'measurement_unit' => "pcs",
                'unit_volume' => null,
                'remaining_volume' => null,
                'unit_quantity' => $total_units,
                'remaining_quantity' => $total_units,
                'status' => "Sealed",
                'unit_price' => $request->input('price_per_item')
            ]);
        } else {
            $global_unit_number = 1; // Start unit numbering globally

            for ($package = 1; $package <= $request->packages_received; $package++) {
                for ($unit = 1; $unit <= $request->items_per_package; $unit++) {

                    if (strtolower($request->package_type) == 'vial' || strtolower($request->package_type) == 'piece') {
                        // Global increment
                        $unit_number = $global_unit_number++;
                    } else {
                        // Reset numbering per package
                        $unit_number = $unit;
                    }

                    Inventory_units::create([
                        'item_id'            => $item->id,
                        'stock_id'           => $stock->id,
                        'package_number'     => $package,
                        'unit_number'        => $unit_number,
                        'measurement_unit'   => "ml",
                        'unit_volume'        => $request->volume_per_item,
                        'remaining_volume'   => $request->volume_per_item,
                        'unit_quantity'      => null,
                        'remaining_quantity' => null,
                        'status'             => "Sealed",
                        'unit_price'         => $request->price_per_item
                    ]);
                }
            }
        }
        return redirect()->route('clinic.supplies')->with('success', 'New supplies added successfully.');
    }
}
