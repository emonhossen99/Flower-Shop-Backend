<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Enan\PathaoCourier\Facade\PathaoCourier;

class PathaoCourierService
{
    protected $baseUrl;
    protected $clientId;
    protected $clientSecret;
    protected $granttype;
    protected $userName;
    protected $password;

    public function __construct()
    {
        $this->baseUrl = env('PATHAO_API_URL');
        $this->clientId = env('PATHAO_CLIENT_ID');
        $this->clientSecret = env('PATHAO_CLIENT_SECRET');
        $this->granttype = env('PATHAO_GRANT_TYPE');
        $this->userName = env('PATHAO_USERNAME');
        $this->clientSecret = env('PATHAO_CLIENT_SECRET');
        $this->password = env('PATHAO_PASSWORD');
    }

    public function getTokenResponse()
    {
        try {
            $tokenResponse = Http::timeout(60)->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl  . '/aladdin/api/v1/issue-token', [
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'grant_type' => $this->granttype,
                'username' => $this->userName,
                'password' => $this->password,
            ]);
            return $tokenResponse;
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'An error occurred while creating the order.',
            ];
        }
    }
}
