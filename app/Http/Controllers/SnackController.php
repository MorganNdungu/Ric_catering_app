<?php
// app/Http/Controllers/SnackController.php
namespace App\Http\Controllers;

use App\Models\Snack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\SnackController;

class SnackController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('snack_images', 'public');
            $data['image_path'] = $imagePath;
        }

        Snack::create($data);

        return redirect()->route('snacks.index')->with('success', 'Snack created successfully.');
    }

    public function index()
    {
    $snacks = Snack::all(); 

    return view('snacks.index', compact('snacks'));
    }

    public function edit($id)
    {
        $snack = Snack::find($id);

        if (!$snack) {
            return redirect()->route('snacks.index')->with('error', 'Snack not found.');
        }

        return view('snacks.edit', compact('snack'));
    }

    public function create()
    {
        return view('snacks.create');
    }

    public function softDelete($id)
    {
         $snack = Snack::find($id);

         if (!$snack) {
            return redirect()->route('snacks.index')->with('error', 'Snack not found.');
        }

        Storage::delete($snack->image_path);

        $snack->delete();

        return redirect()->route('snacks.index')->with('success', ' deleted successfully.');
    }


    public function update(Request $request, Snack $snack)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($snack->image_path) {
                Storage::disk('public')->delete($snack->image_path);
            }

            // Upload new image
            $imagePath = $request->file('image')->store('snack_images', 'public');
            $data['image_path'] = $imagePath;
        }

        $snack->update($data);

        return redirect()->route('snacks.index')->with('success', 'Snack updated successfully.');
    }

}
