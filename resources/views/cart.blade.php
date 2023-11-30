@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/cart.css') }}" rel="stylesheet" type="text/css">

    <div> <!-- Add this div tag to properly open the container -->
        <h1>Shopping Cart</h1>

        @if ($cartItems->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartItems as $cartItem)
                        <tr>
                            <td>{{ $cartItem->item->title }}</td>
                            <td>ksh{{ $cartItem->item->price }}</td>
                            <td>
                                <form action="{{ route('cart.update', $cartItem->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="quantity" value="{{ $cartItem->quantity }}" min="1">
                                    <button type="submit" class="button">Update</button>
                                </form>
                            </td>
                            <td>ksh{{ $cartItem->subtotal }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p>Total: ksh{{ $total }}</p>
            <a href="{{ route('checkout') }}" class="button">Checkout</a>
        @else
            <p>Your cart is empty.</p>
        @endif
    </div> <!-- Close the div tag to properly close the container -->
@endsection
