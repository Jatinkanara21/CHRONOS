<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Watch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function checkout() {
        $cartItems = CartItem::where('user_id', Auth::id())->with('watch')->get();
        if ($cartItems->isEmpty()) return redirect()->route('cart.index');
        
        $total = $cartItems->sum(fn($item) => $item->watch->price * $item->quantity);
        return view('user.checkout', compact('cartItems', 'total'));
    }

    public function placeOrder(Request $request) {
        $request->validate([
            'address' => 'required',
            'phone' => 'required',
        ]);

        return DB::transaction(function () use ($request) {
            $cartItems = CartItem::where('user_id', Auth::id())->with('watch')->get();
            
            if ($cartItems->isEmpty()) return redirect()->route('home');

            // 1. Calculate Total & Create Order
            $total = $cartItems->sum(fn($item) => $item->watch->price * $item->quantity);
            
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => 'ORD-' . strtoupper(Str::random(10)),
                'total_price' => $total,
                'shipping_address' => $request->address,
                'phone' => $request->phone,
                'status' => 'pending'
            ]);

            // 2. Create Order Items & Deduct Stock
            foreach ($cartItems as $item) {
                // Stock Check
                if ($item->watch->stock < $item->quantity) {
                    throw new \Exception("Watch {$item->watch->name} is out of stock.");
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'watch_id' => $item->watch_id,
                    'watch_name' => $item->watch->name,
                    'price' => $item->watch->price,
                    'quantity' => $item->quantity
                ]);

                // Deduct Stock
                $item->watch->decrement('stock', $item->quantity);
            }

            // 3. Clear Cart
            CartItem::where('user_id', Auth::id())->delete();

            return redirect()->route('orders.show', $order->id)->with('success', 'Order placed successfully!');
        });
    }

    public function history() {
        $orders = Order::where('user_id', Auth::id())->latest()->paginate(5);
        return view('user.orders.index', compact('orders'));
    }

    public function show($id) {
        $order = Order::where('user_id', Auth::id())->where('id', $id)->with('items')->firstOrFail();
        return view('user.orders.show', compact('order'));
    }
}