<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Product;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::with('product')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('Admin.inventory.index', compact('inventories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'stock' => 'required|integer|min:0',
            'reserved' => 'nullable|integer|min:0',
            'sold' => 'nullable|integer|min:0',
            'notes' => 'nullable|string',
        ]);

        Inventory::create($data);

        return redirect()->back()->with('success', 'Inventory added successfully.');
    }

    public function update(Request $request, $id)
    {
        $inventory = Inventory::findOrFail($id);

        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'stock' => 'required|integer|min:0',
            'reserved' => 'nullable|integer|min:0',
            'sold' => 'nullable|integer|min:0',
            'notes' => 'nullable|string',
        ]);

        $inventory->update($data);

        return redirect()->back()->with('success', 'Inventory updated successfully.');
    }

    public function destroy(Inventory $inventory)
    {
        $inventory->delete();

        return redirect()->back()->with('success', 'Inventory deleted successfully.');
    }
}
