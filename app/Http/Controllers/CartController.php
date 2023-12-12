<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use App\Models\CartItem;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request; 

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
                $cartItemCount = $cart->cartItems->count();
            } else {
                $cartItems = collect(); // Create an empty collection if the cart is not found.
                $total = 0; 
            }
    
            return view('cart', compact('cartItems', 'total', 'cartItemCount'));
        } else {
            // Handle the case where the user is not authenticated, e.g., show a login form or redirect to the login page.
            return redirect()->route('login')->with('status', 'Please log in to add items to your cart.');
        }
    }
    
       

    public function viewCart()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $cart = Cart::firstOrCreate(['user_id' => $user->id]);
            $cartItemCount = $cart->cartItems->count(); 
            $cartItems = $cart->cartItems;
            $total = $cartItems->sum(function ($cartItem) {
                return $cartItem->item->price * $cartItem->quantity;
            });
        } else {
            // Handle the case where the user is not authenticated
            $cartItemCount = 0; 
            $cartItems = collect(); 
            $total = 0; 
        }
    
        return view('cart', compact('cartItems', 'total', 'cartItemCount'));
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
        
        // Update the cart item count after removing an item
        $user = Auth::user();
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);
        $cartItemCount = $cart->cartItems->count();
        
        return redirect()->route('cart.view')->with('status', 'Item removed from cart.');
    }
    
}
