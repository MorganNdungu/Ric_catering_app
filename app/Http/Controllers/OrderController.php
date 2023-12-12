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

    // Calculate total based on cart items or other logic
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
        // Clear the cart
        $cart->cartItems()->delete();

        // Check if the payment method is M-Pesa
        if ($request->payment === 'm-pesa') {
            // Get the phone number from the request
            $phoneNumber = $request->input('phone');

            // Generate a unique transaction ID
            $transactionId = uniqid();

            // Redirect to a confirmation page with the M-Pesa phone number
            return redirect()->route('order.confirmation', [
                'name' => $order->name,
                'address' => $order->address,
                'paymentMethod' => $order->payment,
                'mpesaPhone' => $phoneNumber,
                'total' => $total, // Pass the total to the confirmation page
            ]);
        }

        // Redirect to a confirmation page or do other necessary actions
        return redirect()->route('order.confirmation', [
            'name' => $order->name,
            'address' => $order->address,
            'paymentMethod' => $order->payment,
            'total' => $total, // Pass the total to the confirmation page
        ]);
    } else {
        // Handle the case where the order failed to save
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
