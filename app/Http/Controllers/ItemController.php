<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ItemController;
use App\Http\Requests\UpdateItemRequest;

class ItemController extends Controller
{
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
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $item = new Item;
        $item->title = $request->title;
        $item->description = $request->description;
        $item->price = $request->price;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $item->image = $imageName;
        }

        $item->save();

        return redirect()->route('items.index')->with('status', 'Item created successfully');
    }

    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    public function update(UpdateItemRequest $request, Item $item)
    {
        
        $item->update($request->validated());

        return redirect()->route('items.index')->with('status', 'Item updated successfully');
    }

    public function softDelete($id)
    {
         $item = Item::find($id);

         if (!$item) {
            return redirect()->route('items.index')->with('error', 'Item not found.');
        }

        Storage::delete($item->image_path);

        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item soft deleted successfully.');
    }
    public function show(Item $item)
    {
    return view('items.show', compact('item'));
    }

}
