@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/confirm.css') }}" rel="stylesheet" type="text/css">

    @php
     $user = Auth::user();
     $userPhone = $user->phone ?? 'N/A'; 
    @endphp
    
    <div class="confirmation-container">
        <h1>Order Confirmation</h1>
        <p>Your order has been successfully placed.</p>
        <p>Thank you for choosing our service.</p>
        <p>Order Details:</p>
        <ul>
            <li><strong>Name:</strong> {{ $name }}</li>
            <li><strong>Address:</strong> {{ $address }}</li>
            <li><strong>Payment Method:</strong> {{ $paymentMethod }}</li>
            @if ($paymentMethod === 'm-pesa')
                <li><strong>M-Pesa Number:</strong> {{ $mpesaPhone }}</li>
            @endif
        </ul>
    </div>
@endsection
