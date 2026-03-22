<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Watch;

class AdminController extends Controller
{
    public function loginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function dashboard()
    {
        $totalWatches = Watch::count();
        $lowStock = Watch::where('stock', '<', 3)->count();
        $recentWatches = Watch::latest()->take(5)->get();
        
        return view('admin.dashboard', compact('totalWatches', 'lowStock', 'recentWatches'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }
    public function notifications()
    {
        $enabled = \App\Models\SiteSetting::getValue('notifications_enabled', '1');
        
        $logs = \Illuminate\Notifications\DatabaseNotification::latest()->paginate(10);
        
        return view('admin.notifications', compact('enabled', 'logs'));
    }

    public function toggleNotifications(Request $request)
    {
        \App\Models\SiteSetting::setValue('notifications_enabled', $request->has('enabled') ? '1' : '0');
        return back()->with('success', 'Global notifications status updated.');
    }

    public function broadcast(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'message' => 'required|string',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:5000'
        ]);

        $filepath = null;
        if ($request->hasFile('file')) {
            $filepath = $request->file('file')->store('notifications', 'public');
        }

        $users = \App\Models\User::where('is_admin', false)->get();
        \Illuminate\Support\Facades\Notification::send($users, new \App\Notifications\CustomAdminNotification($request->title, $request->message, null, $filepath));

        return back()->with('success', 'Broadcast notification dispatched.');
    }
}