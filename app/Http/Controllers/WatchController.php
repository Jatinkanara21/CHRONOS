<?php

namespace App\Http\Controllers;

use App\Models\Watch;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WatchController extends Controller
{
    // List all watches in Admin
    public function index()
    {
        // Eager load category to prevent N+1 query issues
        $watches = Watch::with('category')->latest()->paginate(10);
        return view('admin.watches', compact('watches'));
    }

    // Show the Create Form
    public function create()
    {
        // 1. Fetch categories for the dropdown
        $categories = Category::all();
        
        // 2. Return the view with the categories variable
        return view('admin.create-watch', compact('categories'));
    }

    // Store the new watch in Database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id', // Validate Category
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('image')->store('watches', 'public');

        Watch::create([
            'name' => $request->name,
            'brand' => $request->brand,
            'price' => $request->price,
            'description' => $request->description,
            'stock' => $request->stock,
            'category_id' => $request->category_id, // Save Category
            'image' => $path,
        ]);

        return redirect()->route('admin.watches.index')->with('success', 'Watch added successfully.');
    }

    // Show the Edit Form
    public function edit($id)
    {
        $watch = Watch::findOrFail($id);
        $categories = Category::all();
        return view('admin.edit-watch', compact('watch', 'categories'));
    }

    // Update the watch
    public function update(Request $request, $id)
    {
        $watch = Watch::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Image is optional on update
        ]);

        // Handle Image Upload
        if ($request->hasFile('image')) {
            // Delete old image
            if($watch->image) {
                Storage::disk('public')->delete($watch->image);
            }
            $path = $request->file('image')->store('watches', 'public');
            $watch->image = $path;
        }

        // Update other fields
        $watch->update([
            'name' => $request->name,
            'brand' => $request->brand,
            'price' => $request->price,
            'description' => $request->description,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            // Note: We don't update 'image' here because we handled it manually above
        ]);
        
        // Ensure image change is saved if it happened
        if ($request->hasFile('image')) {
            $watch->save();
        }

        return redirect()->route('admin.watches.index')->with('success', 'Watch updated.');
    }

    // Delete the watch
    public function destroy($id)
    {
        try {
            // 1. Try to find and delete the watch
            $watch = \App\Models\Watch::findOrFail($id);
            $watch->delete();
            
            // 2. If successful, redirect with success message
            return redirect()->route('admin.watches.index')
                ->with('success', 'Watch successfully deleted.');
                
        } catch (\Illuminate\Database\QueryException $e) {
            // 3. CATCH THE ERROR if the database says "No!"
            // Error Code 23000 means the watch is linked to an order
            if ($e->getCode() == "23000") {
                return back()->with('error', 'Action Denied: You cannot delete this watch because it is part of a customer\'s order history.');
            }
            
            // Catch any other database errors
            return back()->with('error', 'Database error: ' . $e->getMessage());
        }
    }
}