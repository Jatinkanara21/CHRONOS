<?php

namespace App\Http\Controllers;

use App\Models\Watch;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Fetch Featured Watches
        $featuredWatches = Watch::with('category')->latest()->take(3)->get();

        // 2. Fetch Brands (Fix for Undefined Variable)
        $brands = Watch::select('brand')->distinct()->pluck('brand');

        // 3. Pass both variables to the view
        return view('user.home', compact('featuredWatches', 'brands'));
    }

    // ... keep your other functions (watches, show) as they are ...
    
    public function watches(Request $request)
    {
        // ... existing code ...
        $query = Watch::with('category'); 
        
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%");
            });
        }

        $watches = $query->latest()->paginate(9)->withQueryString();
        $brands = Watch::select('brand')->distinct()->pluck('brand');
        
        return view('user.watches', compact('watches', 'brands'));
    }

    public function show($id)
    {
        $watch = Watch::findOrFail($id);
        $related = Watch::where('brand', $watch->brand)->where('id', '!=', $id)->take(3)->get();
        return view('user.watch-details', compact('watch', 'related'));
    }

}