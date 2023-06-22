<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalController extends Controller
{
    public function paypalTotal(Request $request, $total, $successUrl)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $currency = (new BaseController())->getLocation($request);
        if ($currency == "VND") {
            $total = $total * 1000;
        }
        $total = convertCurrency($currency, 'USD', $total);

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => $successUrl,
                "cancel_url" => route('checkout.cancel'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => (integer) ($total+1),
                    ]
                ]
            ]
        ]);

        return $response;
    }
}
