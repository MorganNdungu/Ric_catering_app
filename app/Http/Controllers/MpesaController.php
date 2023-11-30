<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MpesaController extends Controller
{
    public function getAccessToken(){

        $url = env('MPESA_ENV') == 0

        ? 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials'
        : 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

        $curl = curl_init($url);
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_HTTPHEADER => ['Content-Type: application/json; charset=utf8'] ,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER => false,
                CURLOPT_USERPWD => env('MPESA_CONSUMER_KEY') . ':' . env('MPESA_CONSUMER_SECRET'),



            )
         
        // $mpesa= new \Safaricom\Mpesa\Mpesa();
        // $BusinessShortCode = '174379';
        // $LipaNaMpesaPasskey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
        // $TransactionType ='CustomerPayBillOnline';
        // $Amount = '1';
        // $PartyA = '254112812463';
        // $PartyB = '174379';
        // $PhoneNumber = '254112812463';
        // $CallBackURL = 'https://sandbox.safaricom.co.ke/mpesa/b2b/v1/paymentrequest';
        // $AccountReference = 'AccountReference';
        // $TransactionDesc = 'TransactionDesc';
        // $Remarks = 'Remarks';

        // $stkPushSimulation=$mpesa->STKPushSimulation($BusinessShortCode, $LipaNaMpesaPasskey, $TransactionType, $Amount, $PartyA, $PartyB, $PhoneNumber, $CallBackURL, $AccountReference, $TransactionDesc, $Remarks
    );
        $response = (curl_exec($curl));
    \curl_close($curl);

    return $response;

    }
}
