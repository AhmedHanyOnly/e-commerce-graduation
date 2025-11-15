<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class Tamara
{
    public $publishable_api_key, $secret_api_key;

    public function __construct()
    {
        $this->publishable_api_key = 'pk_test_HZZtJUWzaiAu8cS8WGcovGutFCQPoTUyLAT2qjLK';
        $this->secret_api_key = 'sk_test_HbjB9XkLXXCmr99HxCRxFVzUvQvMYogAhYndZJfC';
    }

    public function createPayment($amount)
    {
        $url ='https://api.moyasar.com/v1/payments';
        $data = [
            "publishable_api_key" => $this->publishable_api_key,
            "amount" => $amount,
            "currency" => "SAR",
            "description" => "test test",
            "source" => [
                "type" => "stcpay",
                "mobile" => "0500876876",
                "cashier" => "cashier_1_id"
            ]
        ];
        $res =Http::post($url,$data);
        return $res;
    }


}
