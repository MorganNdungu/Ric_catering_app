@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/checkout.css') }}" rel="stylesheet" type="text/css">

    <h1>Checkout</h1>
    <form id="checkoutForm" action="{{ route('order.place') }}" method="POST">
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
            <input type="text" name="phone" id="mpesaPhoneField" required>
        </div>
        
        <!-- Add input for the amount -->
        <label for="amount">Amount</label>
        <input type="number" name="amount" id="amount" required>
        
        <button type="button" onclick="prepareCheckout()" class="button">Place Order</button>
    </form>

    <script>
        const paymentMethod = document.getElementById('paymentMethod');
        const mpesaPhone = document.getElementById('mpesaPhone');
        const amountField = document.getElementById('amount');

        paymentMethod.addEventListener('change', function () {
            if (paymentMethod.value === 'm-pesa') {
                mpesaPhone.style.display = 'block';
            } else {
                mpesaPhone.style.display = 'none';
            }
        });

        function prepareCheckout() {
            // Validate the form before submitting
            if (validateForm()) {
                // Set the dynamic amount field before submitting
                const form = document.getElementById('checkoutForm');
                const formData = new FormData(form);
                const amount = formData.get('amount');
                document.getElementById('amount').value = amount;

                // Send STK Push request
                sendStkPushRequest();

                // You can submit the form to place the order after sending STK Push
                // form.submit();
            } else {
                alert('Please fill in all required fields.');
            }
        }

        function validateForm() {
            // Add any additional validation logic here
            return true;
        }

        function sendStkPushRequest() {
            // You need to implement the logic to send the STK Push request using Daraja API
            // Use AJAX or any HTTP client library to send the request
            // Example using fetch API:
            fetch('{{ route('mpesa.stk') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    phone: document.getElementById('mpesaPhoneField').value,
                    amount: document.getElementById('amount').value,
                }),
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                // Handle the response, e.g., show a message to the user
            })
            .catch(error => {
                console.error('Error:', error);
                // Handle errors, e.g., show an error message to the user
            });
        }
    </script>
</div>
@endsection
