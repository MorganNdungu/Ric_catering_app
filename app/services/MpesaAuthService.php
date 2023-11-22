<?php

namespace App\Services;

use App\Services\MpesaAuthService;
use Illuminate\Support\Facades\Http;

class MpesaAuthService
{
    public static function getAccessToken()
    {
        $response = Http::post('https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials', [
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode(config('services.mpesa.consumer_key') . ':' . config('services.mpesa.consumer_secret')),
            ],
        ]);

        $data = $response->json();

        return $data['access_token'];
    }
}
