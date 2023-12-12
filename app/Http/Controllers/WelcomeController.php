<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\WelcomeController;

class WelcomeController extends Controller
{
    public function index()
    {
        $featuredItems = Item::take(3)->get(); 

        return view('welcome', compact('featuredItems'));
    }
    public function show(Item $item)
{
    return view('items.show', compact('item'));
}

}
