<?php

namespace App\Http\Controllers\ClinicUser;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Inventory_items;
use App\Models\Inventory_stock;
use App\Models\Inventory_units;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ManageInventorySupplies extends Controller
{
    public function index($id)
    {
        $inventoryItem = Inventory_items::findOrFail($id);
        $inventoryRecords = Inventory::findOrFail($id);
        $clinicUser = Auth::user();
        return view('ClinicUser.supplies-manage', compact('clinicUser', 'inventoryItem', 'inventoryRecords'));
    }


    //function to add new stocks
    public function add_new_stock(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:inventory_items,id',
            'package_type' => 'required|string|max:255',
            'packages_received' => 'required|integer|min:1',
            'items_per_package' => 'required|integer|min:1',
            'volume_per_item' => 'nullable|numeric|min:0',
            'price_per_item' => 'required|numeric|min:0',
            // 'total_price' => 'required|numeric|min:0',
            'supplier' => 'required|string|max:255',

        ]);


        $total_units = $request->packages_received * $request->items_per_package;

        $stock = Inventory_stock::create([
            'item_id' => $request->item_id,
            'package_type' => $request->package_type,
            'packages_received' => $request->packages_received,
            'items_per_package' => $request->items_per_package,
            'unit_type' => "pcs",
            'total_units' => $total_units,
            'total_remaining_units' => $total_units,
            'total_package_amount' => $request->price_per_item * $total_units,
            'restock_date' => now(),
            'supplier' => $request->supplier,
        ]);

        if (strtolower($request->category) === 'supply' || strtolower($request->category) === 'equipment') {
            Inventory_units::create([
                'item_id' => $request->item_id,
                'stock_id' => $stock->id,
                'package_number' =>  Inventory_units::where('item_id', $request->item_id)->max('package_number') + 1,
                'unit_number' => 1,
                'measurement_unit' => "pcs",
                'unit_volume' => null,
                'remaining_volume' => null,
                'unit_quantity' => $total_units,
                'remaining_quantity' => $total_units,
                'status' => "Sealed",
                'unit_price' => $request->price_per_item
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
                        'item_id'            => $request->item_id,
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
        $id = $request->item_id;

        return redirect()
            ->route('clinic.supplies.manage', $id)
            ->with('success', 'New supplies added successfully.');
    }


//function to edit product details
    public function editProduct(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:inventory_items,id',
            'brand_name' => 'required|string|max:255',
            'product_type' => 'required|string|max:255',
            'immunity_type' => 'nullable|string|max:255',
        ]);

        $item = Inventory_items::findOrFail($request->item_id);

        // Assign new values
        $item->brand_name   = $request->brand_name;
        $item->product_type = $request->product_type;
        $item->immunity_type = $request->immunity_type;

        // Only save if there are changes
        if ($item->isDirty()) {
            $item->save();

            return redirect()
                ->route('clinic.supplies.manage', $request->item_id)
                ->with('edit-success', 'Product details updated successfully.');
        }

        return redirect()
            ->route('clinic.supplies.manage', $request->item_id)
            ->with('edit-success', 'No changes were made.');
    }


    //function to update quantity on box or pack
    public function updateQuantity(Request $request)
    {
        $request->validate([

            'id' => 'required|exists:inventory_units,id',
            'item_id' => 'required|exists:inventory_items,id',
            'stock_id' => 'required|exists:inventory_stocks,id',
            'quantity' => 'required|integer|min:0',
            'remaining_quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        $item = Inventory_units::findOrFail($request->id);
        $item->update([
            'quantity' => $request->quantity,
            'remaining_quantity' => $request->remaining_quantity,
            'unit_price' => $request->price,
        ]);

        $stock = Inventory_stock::findOrFail($request->stock_id);

        $package_amount = $request->quantity * $request->price;

        $stock->update([
            'items_per_package' => $request->quantity,
            'total_units' => $request->quantity,
            'total_remaining_units' => $request->remaining_quantity,
            'total_package_amount' => $package_amount,
        ]);

        return redirect()
            ->route('clinic.supplies.manage', $request->item_id)
            ->with('edit-item-success', 'Inventory item updated successfully.');
    }

}
