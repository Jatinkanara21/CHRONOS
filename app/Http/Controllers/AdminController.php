<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Watch; 
use App\Models\User;  

class AdminController extends Controller
{

    public function login(Request $request)
    {
        $info = $request->only('email', 'password');

        if (Auth::attempt($info)) {
            return redirect('/admin/dashboard');
        }

        return back()->with('error', 'Wrong email or password.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/admin/login');
    }


    public function dashboard()
    {
        return view('admin.dashboard', [
            'total'    => Watch::count(),               
            'lowStock' => Watch::where('stock', '<', 3)->count(),
            'recent'   => Watch::latest()->take(5)->get() 
        ]);
    }


    // --- 3. SEND MESSAGE TO ALL USERS ---

    public function broadcast(Request $request)
    {
        $title = $request->input('title');
        $text  = $request->input('message');

        $customers = User::where('is_admin', false)->get();

        foreach ($customers as $user) {
            $user->notify(new \App\Notifications\CustomAdminNotification($title, $text));
        }

        return back()->with('success', 'Message sent to all users!');
    }
}
