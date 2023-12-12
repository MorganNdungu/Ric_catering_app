<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
{
    $user = Auth::user();
    $cart = Cart::firstOrCreate(['user_id' => $user->id]);
    $cartItems = $cart->cartItems;

    $total = $this->calculateTotal($cartItems);

    // Create an order for the user with cart items
    $order = new Order();
    $order->user_id = $user->id;
    $order->name = $request->input('name');
    $order->address = $request->input('address');
    $order->payment = $request->input('payment');
    $order->items = $cartItems;
    $order->total = $total;

    // Check if the order was saved successfully
    if ($order->save()) {

        $cart->cartItems()->delete();

        if ($request->payment === 'm-pesa') {
            $phoneNumber = $request->input('phone');

            $transactionId = uniqid();

            return redirect()->route('order.confirmation', [
                'name' => $order->name,
                'address' => $order->address,
                'paymentMethod' => $order->payment,
                'mpesaPhone' => $phoneNumber,
                'total' => $total, 
            ]);
        }

        // return redirect()->route('order.confirmation', [
        //     'name' => $order->name,
        //     'address' => $order->address,
        //     'paymentMethod' => $order->payment,
        //     'total' => $total, 
        // ]);
    } else {
        return redirect()->back()->with('error', 'Failed to place the order.');
    }
}

    public function confirmation(Request $request)
    {
        // Retrieve order details from the request
        $name = $request->input('name');
        $address = $request->input('address');
        $paymentMethod = $request->input('payment');
        $mpesaPhone = $request->input('mpesaPhone');

        return view('order.confirmation', compact('name', 'address', 'paymentMethod', 'mpesaPhone'));
    }
    private function calculateTotal($cartItems)
{
    
    return $cartItems->sum(function ($cartItem) {
        return $cartItem->quantity * $cartItem->item->price;
    });
}
}
