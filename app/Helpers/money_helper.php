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
                'X-RapidAPI-Key' => '60b2ed8013msh5c0318853ce4f2ep178ad5jsn926b83d5fad1',
                'X-RapidAPI-Host' => 'currency-conversion-and-exchange-rates.p.rapidapi.com',
            ],
        ]);

        $responseBody = $response->getBody()->getContents();
        $data = json_decode($responseBody, true);

        return $data['result'];
    }
}
