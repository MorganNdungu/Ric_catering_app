<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MpesaController extends Controller
{
    public function stk(){
        $mpesa= new \Safaricom\Mpesa\Mpesa();
        $BusinessShortCode = '174379';
        $LipaNaMpesaPasskey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
        $TransactionType ='CustomerPayBillOnline';
        $Amount = '1';
        $PartyA = '254112812463';
        $PartyB = '174379';
        $PhoneNumber = '254112812463';
        $CallBackURL = 'https://sandbox.safaricom.co.ke/mpesa/b2b/v1/paymentrequest';
        $AccountReference = 'AccountReference';
        $TransactionDesc = 'TransactionDesc';
        $Remarks = 'Remarks';

        $stkPushSimulation=$mpesa->STKPushSimulation($BusinessShortCode, $LipaNaMpesaPasskey, $TransactionType, $Amount, $PartyA, $PartyB, $PhoneNumber, $CallBackURL, $AccountReference, $TransactionDesc, $Remarks
    );
    dd($stkPushSimulation);

    }
}
