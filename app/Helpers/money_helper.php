<?php

use \GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

if (!function_exists('convertCurrency')) {
    function convertCurrency($from, $to, $amount)
    {

        if (Cache::has('exchange_rate')) {
            $rate = Cache::get('exchange_rate');
        } else {
            $rate = getExchangeRate($from, $to, $amount);
        }
        return $rate * $amount;

    }

    function getExchangeRate($from, $to, $amount)
    {

        Cache::flush();

        $client = new Client();
        $response = $client->request('GET', 'https://currency-conversion-and-exchange-rates.p.rapidapi.com/convert', [
            'query' => [
                'to' => $to,
                'from' => $from,
                'amount' => $amount,
            ],
            'headers' => [
                'X-RapidAPI-Key' => '79b4b17bc4msh2cb9dbaadc30462p1f029ajsn6d21b28fc4af',
                'X-RapidAPI-Host' => 'currency-conversion-and-exchange-rates.p.rapidapi.com',
            ],
        ]);
        $responseBody = $response->getBody()->getContents();
        $data = json_decode($responseBody, true);
        $rate = $data['info']['rate'];

        Cache::put('exchange_rate', $rate, 5);

        return $rate;
    }
}
