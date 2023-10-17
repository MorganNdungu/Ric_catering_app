@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/checkout.css') }}" rel="stylesheet" type="text/css">

    <h1>Checkout</h1>
    <form action="{{ route('order.place') }}" method="POST">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" required>
        <label for="address">Address</label>
        <textarea name="address" required></textarea>
        <label for="payment">Payment Method</label>
        <select name="payment" id="paymentMethod" required>
            <option value="credit_card">Credit Card</option>
            <option value="paypal">PayPal</option>
            <option value="m-pesa">M-Pesa</option>
        </select>
        
        <div id="mpesaPhone" style="display: none;">
            <label for="phone">Phone Number</label>
            <input type="text" name="phone" id="mpesaPhoneField">
        </div>
        
        <button type="submit" class="button">Place Order</button>
    </form>

    <script>
        const paymentMethod = document.getElementById('paymentMethod');
        const mpesaPhone = document.getElementById('mpesaPhone');

        paymentMethod.addEventListener('change', function () {
            if (paymentMethod.value === 'm-pesa') {
                mpesaPhone.style.display = 'block';
            } else {
                mpesaPhone.style.display = 'none';
            }
        });
    </script>
</div>
@endsection
