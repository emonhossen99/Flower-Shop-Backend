<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class BDCourierService
{
    protected $apiUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->apiUrl = env('BD_COURIER_API_URL');
        $this->apiKey = env('BD_COURIER_API_KEY');
    }

    public function getHistoryByPhoneNumber($phoneNumber)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Accept' => 'application/json'
        ])->get('https://bdcourier.com/api/courier-check?phone='.$phoneNumber);
        return $response->json();
    }
}

