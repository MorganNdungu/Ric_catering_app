<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BirthdayPackage;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\BirthdayPackageController;

class BirthdayPackageController extends Controller
{
    
    public function index()
    {
        $birthdayPackages = BirthdayPackage::all();
        return view('birthday_packages.index', compact('birthdayPackages'));
    }
    
    
        public function create()
        {
            return view('birthday_packages.create');
        }
    
        public function store(Request $request)
        {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|numeric',
                'images' => 'required|array',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    
            // Create a new BirthdayPackage instance and save it
            $package = BirthdayPackage::create([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'price' => $validatedData['price'],
            ]);
    
            // Handle the image uploads
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('birthday_package_images', 'public');
                $package->images()->create(['image_path' => $imagePath]);
            }
    
            return redirect()->route('birthday_packages.index')->with('success', 'Package created successfully');
    }
    
    
    public function show(BirthdayPackage $package)
        {
            return view('birthday_packages.show', compact('package'));
    }
    
    public function edit($id)
    {
        $package = BirthdayPackage::find($id);
    
        if (!$package) {
            return redirect()->route('birthday_packages.index')->with('error', 'Package not found.');
        }
    
        return view('birthday_packages.edit', compact('package'));
    }
    

    
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Update validation as needed
        ]);

        $package = BirthdayPackage::find($id);

        if (!$package) {
            return redirect()->route('birthday_packages.index')->with('error', 'Package not found.');
        }

        $package->name = $validatedData['name'];
        $package->description = $validatedData['description'];
        $package->price = $validatedData['price'];

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($package->image_path) {
                Storage::disk('public')->delete($package->image_path);
            }

            // Upload new image
            $imagePath = $request->file('image')->store('birthday_package_images', 'public');
            $package->image_path = $imagePath;
        }

        $package->save();

        return redirect()->route('birthday_packages.index')->with('success', 'Package updated successfully.');
    }

    public function softDelete($id)
{
    $package = BirthdayPackage::find($id);

    if (!$package) {
        return redirect()->route('birthday_packages.index')->with('error', 'Package not found.');
    }

    // Delete associated images
    foreach ($package->images as $image) {
        Storage::delete($image->image_path);
        $image->delete();
    }

    // Soft delete the package
    $package->delete();

    return redirect()->route('birthday_packages.index')->with('success', 'Birthday package deleted successfully.');
}
public function addBook($id)
{
    $package = BirthdayPackage::find($id);

    if (!$package) {
        return redirect()->route('birthday_packages.index')->with('error', 'Package not found.');
    }


    return view('birthday_packages.add_book', compact('package'));
}


    
}
