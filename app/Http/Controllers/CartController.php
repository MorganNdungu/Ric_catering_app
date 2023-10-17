<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use App\Models\CartItem;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request; // Make sure to import the Request class

class CartController extends Controller {
    public function addItemToCart(Item $item)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $cart = Cart::firstOrCreate(['user_id' => $user->id]);
            $quantity = request('quantity');
    
            // Use firstOrCreate to ensure a cart item is created or retrieved
            $cartItem = CartItem::firstOrCreate([
                'cart_id' => $cart->id,
                'item_id' => $item->id,
            ]);
    
            // Increment the quantity of the existing cart item
            $cartItem->quantity += $quantity;
            $cartItem->save();
    
            // Fetch the updated cart data
            $cart = Cart::where('user_id', auth()->id())->first();
    
            if ($cart) {
                $cartItems = $cart->cartItems;
                $total = $cartItems->sum(function ($cartItem) {
                    return $cartItem->item->price * $cartItem->quantity;
                });
            } else {
                $cartItems = collect(); // Create an empty collection if the cart is not found.
                $total = 0; // Total is zero when the cart is empty.
            }
    
            return view('cart', compact('cartItems', 'total'));
        } else {
            // Handle the case where the user is not authenticated, e.g., show a login form or redirect to the login page.
            return redirect()->route('login')->with('status', 'Please log in to add items to your cart.');
        }
    }
    
       

    public function viewCart()
{
    $user = Auth::user();
    $cart = Cart::firstOrCreate(['user_id' => $user->id]);
    $cartItems = $cart->cartItems;
    $total = $cartItems->sum(function ($cartItem) {
        return $cartItem->item->price * $cartItem->quantity;
    });

    return view('cart', compact('cartItems', 'total'));
}

    public function updateCartItem(CartItem $cartItem)
    {
        $cartItem->quantity = request('quantity');
        $cartItem->save();

        return redirect()->route('cart.view')->with('status', 'Cart updated successfully.');
    }

    public function removeCartItem(CartItem $cartItem)
    {
        $cartItem->delete();

        return redirect()->route('cart.view')->with('status', 'Item removed from cart.');
    }
}
