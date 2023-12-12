
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>My Orders</h2>

        @if($orders->isEmpty())
            <p>You have no orders yet.</p>
        @else
            <ul>
                @foreach($orders as $order)
                    <li>Order ID: {{ $order->id }}, Total: {{ $order->total }}</li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
