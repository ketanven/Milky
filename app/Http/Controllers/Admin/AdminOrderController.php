<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderStatusHistory;
use Illuminate\Support\Facades\Auth;

class AdminOrderController extends Controller
{
    // Display all orders
    public function index()
    {
        $orders = Order::with(['user', 'address', 'orderItems', 'statusHistory', 'deliverySlot'])
            ->orderBy('created_at', 'desc')
            ->paginate(10); // paginate 10 per page

        return view('Admin.orders.index', compact('orders'));
    }


    // Show single order details
    public function show($id)
    {
        $order = Order::with(['user', 'address', 'orderItems', 'statusHistory', 'deliverySlot'])
            ->findOrFail($id);

        return view('Admin.orders.show', compact('order'));
    }

    // Update order status
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled,returned',
            'note' => 'nullable|string|max:255'
        ]);

        $order = Order::findOrFail($id);
        $order->order_status = $request->status;
        $order->save();

        // Save status history
        OrderStatusHistory::create([
            'order_id' => $order->id,
            'updated_by' => Auth::id(),
            'status' => $request->status,
            'note' => $request->note,
        ]);

        return redirect()->back()->with('success', 'Order status updated successfully!');
    }
}
