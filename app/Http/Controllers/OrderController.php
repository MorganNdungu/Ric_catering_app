<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\OrderController;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        $user = Auth::user();
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);
        $cartItems = $cart->cartItems;
    
        // Create an order for the user with cart items
        $order = new Order();
        $order->user_id = $user->id;
        $order->name = $request->input('name');
        $order->address = $request->input('address');
        $order->payment = $request->input('payment');
        $order->items = $cartItems;
    
        // Check if the order was saved successfully
        if ($order->save()) {
            // Clear the cart
            $cart->cartItems()->delete();
    
            return view('order.confirmation', [
                'name' => $order->name,
                'address' => $order->address,
                'paymentMethod' => $order->payment,
            ]);
        } else {
            // Handle the case where the order failed to save
            return redirect()->back()->with('error', 'Failed to place the order.');
        }
    }
    
}
