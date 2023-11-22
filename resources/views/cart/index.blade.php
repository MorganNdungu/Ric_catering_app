
@extends('layouts.app')

@section('content')
    <h1>Your Cart</h1>

    @if(count($items) > 0)
        <ul>
            @foreach($items as $cartItem)
                <li>{{ $cartItem->itemable->name }} (Quantity: {{ $cartItem->quantity }})</li>
            @endforeach
        </ul>
    @else
        <p>Your cart is empty.</p>
    @endif
@endsection
