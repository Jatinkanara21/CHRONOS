<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Watch;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index() {
        $cartItems = CartItem::where('user_id', Auth::id())->with('watch')->get();
        return view('user.cart', compact('cartItems'));
    }

    public function add(Request $request, $id) {
        $watch = Watch::findOrFail($id);
        
        // Basic check
        if($watch->stock < 1) {
            return back()->withErrors(['msg' => 'Item is out of stock']);
        }

        $cartItem = CartItem::where('user_id', Auth::id())->where('watch_id', $id)->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'watch_id' => $id,
                'quantity' => 1
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Added to cart');
    }

    public function update(Request $request, $id) {
        $cartItem = CartItem::where('user_id', Auth::id())->where('id', $id)->firstOrFail();
        $action = $request->input('action');

        if ($action === 'increase') {
            // Optional: Check stock before increasing
            if($cartItem->watch->stock > $cartItem->quantity) {
                $cartItem->quantity++;
            }
        } elseif ($action === 'decrease' && $cartItem->quantity > 1) {
            $cartItem->quantity--;
        }
        $cartItem->save();
        
        return back();
    }

    public function remove($id) {
        CartItem::where('user_id', Auth::id())->where('id', $id)->delete();
        return back()->with('success', 'Item removed');
    }
}