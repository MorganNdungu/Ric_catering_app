<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update the item with the validated data
        $item->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        // Handle image update if a new image is provided
        if ($request->hasFile('image')) {
            Storage::delete($item->image); // Delete the old image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $item->image = $imageName;
            $item->save();
        }

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    public function index()
    {
        $items = Item::all();
        return view('items.index', compact('items'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Handle image upload
        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        }
    
        // Create a new item with the validated data
        $item = Item::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imageName,
        ]);
    
        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }
    

    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    

    public function softDelete($id)
    {
        $item = Item::find($id);

        if (!$item) {
            return redirect()->route('items.index')->with('error', 'Item not found.');
        }

        Storage::delete($item->image_path);

        $item->delete(); // Soft delete

        return redirect()->route('items.index')->with('success', 'Item soft deleted successfully.');
    }

    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    // Add the destroy method for soft deletion
    public function destroy(Item $item)
    {
        $item->delete(); // Soft delete

        return redirect()->route('items.index')->with('success', 'Item soft deleted successfully.');
    }
}
