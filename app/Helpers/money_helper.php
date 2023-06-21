<?php

use \GuzzleHttp\Client;

if (!function_exists('convertCurrency')) {
    function convertCurrency($from, $to, $amount)
    {
        $client = new Client();
        $response = $client->request('GET', 'https://currency-conversion-and-exchange-rates.p.rapidapi.com/convert', [
            'query' => [
                'to' => $to,
                'from' => $from,
                'amount' => $amount,
            ],
            'headers' => [
                'X-RapidAPI-Key' => 'e5fec28adcmsh01ac8839654caf8p1731bbjsn4ee3310b5513',
                'X-RapidAPI-Host' => 'currency-conversion-and-exchange-rates.p.rapidapi.com',
            ],
        ]);

        $responseBody = $response->getBody()->getContents();
        $data = json_decode($responseBody, true);

        return $data['result'];
    }
}
