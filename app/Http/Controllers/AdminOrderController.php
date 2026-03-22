<?php

namespace App\Http\Controllers; // <--- MUST BE EXACTLY THIS

use Illuminate\Http\Request;
use App\Models\Order;

class AdminOrderController extends Controller
{
    public function index()
    {
        // Get orders with the user who made them
        $orders = Order::with('user')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        // Get order with user and items
        $order = Order::with(['user', 'items.watch'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->route('admin.orders.show', $id)
            ->with('success', 'Order status updated successfully.');
    }
}