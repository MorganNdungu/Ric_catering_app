<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; 
use App\Http\Controllers\Controller;
use Safaricom\Mpesa\Mpesa;

class CheckoutController extends Controller
{
    public function showCheckoutForm()
    {
        return view('checkout');
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'payment' => 'required|in:credit_card,paypal,m-pesa',
            'phone' => 'required_if:payment,m-pesa|numeric',
        ]);

        //processing the order by saving to the database
        $order = Order::create([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'payment_method' => $request->input('payment'),
            'phone' => $request->input('phone'),
        ]);

        // Check if the payment method is M-Pesa
        if ($request->payment === 'm-pesa') {

            // Get the phone number from the request
            $phoneNumber = $request->phone;

            // Generate a unique transaction ID
            $transactionId = uniqid();

            // Initiate the M-Pesa STK Push
            $response = $this->initiateMpesaSTKPush($phoneNumber, $transactionId, $order);

            // Handle the response and redirect
            if ($response->success) {
                return redirect()->route('mpesa.pin', ['transaction_id' => $transactionId]);
            } else {
                // Handle the case where STK Push initiation failed
                return redirect()->route('mpesa.stk', ['transaction_id' => $transactionId]);
            }
        }

        // Redirect to a confirmation page
        return redirect()->route('order.confirmation');
    }

    public function mpesaPin(Request $request)
    {
        // Get the transaction ID from the request
        $transactionId = $request->transaction_id;

        // Render a view prompting the user to enter the M-Pesa PIN
        return view('checkout.mpesa_pin', compact('transactionId'));
    }

    // Function to initiate M-Pesa STK Push
    private function initiateMpesaSTKPush($phoneNumber, $transactionId, $order)
    {
        $mpesa = new Mpesa();

        $businessShortCode = '174379';
        $lipaNaMpesaPasskey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
        $amount = $order->total; 

        $response = $mpesa->STKPushSimulation($businessShortCode, $lipaNaMpesaPasskey, $amount, $phoneNumber, $transactionId);

        return $response;
    }
}
