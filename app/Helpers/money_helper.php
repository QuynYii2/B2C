<?php

use \GuzzleHttp\Client;

if (!function_exists('convertCurrency')) {
    function convertCurrency($from, $to, $amount)
    {
        $client = new Client();
        $response = $client->request('GET', 'https://api.apilayer.com/exchangerates_data/convert', [
            'query' => [
                'to' => $to,
                'from' => $from,
                'amount' => $amount,
            ],
            'headers' => [
                'Content-Type' => 'text/plain',
                'apikey' => '0TzgBcCTnNA3NKONZzGXPLFU7E7J2NUE',
            ],
        ]);

        $responseBody = $response->getBody()->getContents();
        $data = json_decode($responseBody, true);

        return $data['result'];
    }
}
