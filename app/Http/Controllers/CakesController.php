<?php

namespace App\Http\Controllers;

use App\Models\Cake;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\CakesController;

class CakesController extends Controller
{
    public function index()
    {
        $cakes = Cake::all();
        return view('cakes.index', compact('cakes'));
    }

    public function create()
    {
        return view('cakes.create');
    }

   
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Handle the cake image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('cake_images', 'public');

            // Create a new cake instance and save it
            $cake = new Cake([
                'name' => $validatedData['name'],
                'price' => $validatedData['price'],
                'description' => $validatedData['description'],
                'image_path' => $imagePath, 
            ]);

            $cake->save();

            return redirect()->route('cakes.index')->with('success', 'Cake created successfully');
        } else {
            // Handle the case where no image was uploaded
            return back()->withInput()->with('error', 'Please upload an image for the cake.');
        }
    }

   
    // public function order($cakeId)
    // {
    //     return redirect()->route('order.confirmation');
    // }
//     public function add($id)
// {
//     // Assuming you're using the session to store cart items
//     $cartItems = session()->get('cart.cakes', []);

//     // Check if the cake is already in the cart
//     if (in_array($id, $cartItems)) {
//         return redirect()->route('cakes.index')->with('info', 'Cake is already in the cart.');
//     }

//     // If not, add the cake to the cart
//     $cartItems[] = $id;

//     // Update the session with the new cart items
//     session(['cart.cakes' => $cartItems]);

//     // Debug messages
//     // dd("Cake added to cart successfully!", $cartItems);

//     // Redirect back to the cake index
//     return redirect()->route('cakes.index')->with('success', 'Cake added to cart successfully!');
// }



    public function edit($id)
    {
    $cake = Cake::find($id);
    return view('cakes.edit', compact('cake'));
    }

    public function confirmDelete($id)
    {
    $cake = Cake::find($id);

    if (!$cake) {
        return redirect()->route('cakes.index')->with('error', 'Cake not found');
    }

    return view('cakes.confirm-delete', compact('cake'));
    }


    public function softDelete($id)
    {
        $cake = Cake::find($id);

        if (!$cake) {
            return redirect()->route('cakes.index')->with('error', 'Cake not found');
        }

        return view('cakes.soft-delete', compact('cake'));
    }

    public function destroy($id)
    {
        $cake = Cake::find($id);

        if (!$cake) {
            return redirect()->route('cakes.index')->with('error', 'Cake not found');
        }

        Storage::delete($cake->image_path);

        $cake->delete();

        return redirect()->route('cakes.index')->with('success', 'Cake soft deleted successfully');
    }

    public function update(Request $request, $id)
    {
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'description' => 'required|string',
        'image' => 'image|mimes:jpeg,png,jpg,gif',
    ]);

    $cake = Cake::find($id);

    if (!$cake) {
        return redirect()->route('cakes.index')->with('error', 'Cake not found');
    }

    $cake->name = $validatedData['name'];
    $cake->price = $validatedData['price'];
    $cake->description = $validatedData['description'];

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('cake_images', 'public');
        $cake->image_path = $imagePath;
    }

    $cake->save();

    return redirect()->route('cakes.index')->with('success', 'Cake updated successfully');
}


}
