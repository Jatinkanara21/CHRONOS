<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Watch;
use App\Models\NotificationSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlistItems = Wishlist::where('user_id', Auth::id())->with('watch')->latest()->get();
        return view('user.wishlist', compact('wishlistItems'));
    }

    public function add($id)
    {
        Wishlist::firstOrCreate([
            'user_id' => Auth::id(),
            'watch_id' => $id
        ]);

        return back()->with('success', 'Timepiece added to your wishlist.');
    }

    public function remove($id)
    {
        Wishlist::where('user_id', Auth::id())->where('watch_id', $id)->delete();
        return back()->with('success', 'Removed from wishlist.');
    }

    // --- NOTIFICATION SETTINGS ---
    public function settings()
    {
        $settings = NotificationSetting::firstOrCreate(
            ['user_id' => Auth::id()]
        );
        return view('user.notification-settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $settings = NotificationSetting::firstOrCreate(
            ['user_id' => Auth::id()]
        );

        $settings->update([
            'email_new_product' => $request->has('email_new_product'),
            'email_price_drop' => $request->has('email_price_drop'),
            'email_back_in_stock' => $request->has('email_back_in_stock')
        ]);

        return back()->with('success', 'Notification preferences updated.');
    }
}
