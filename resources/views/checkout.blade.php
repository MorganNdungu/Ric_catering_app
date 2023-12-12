@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/checkout.css') }}" rel="stylesheet" type="text/css">

    <h1>Checkout</h1>
    <form id="checkoutForm" action="{{ route('order.place') }}" method="POST" onsubmit="return prepareCheckout()">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" required>
        <label for="address">Address</label>
        <textarea name="address" required></textarea>
        <label for="payment">Payment Method</label>
        <select name="payment" id="paymentMethod" onchange="toggleMpesaPhoneInput()" required>
            <option value="credit_card">Credit Card</option>
            <option value="paypal">PayPal</option>
            <option value="m-pesa">M-Pesa</option>
        </select>
        
        <div id="mpesaPhone" style="display: none;">
            <label for="phone">M-Pesa Number</label>
            <input type="text" name="phone" id="mpesaPhoneField" required>
        </div>
        
        
        <button type="submit" class="button">Place Order</button>
    </form>

   <script>
       function toggleMpesaPhoneInput() {
           var paymentMethod = document.getElementById('paymentMethod');
           var mpesaPhone = document.getElementById('mpesaPhone');

           mpesaPhone.style.display = (paymentMethod.value === 'm-pesa') ? 'block' : 'none';
       }

       // Function to be called on form submission
       function prepareCheckout() {
           
           return true;
       }
   </script>
@endsection
