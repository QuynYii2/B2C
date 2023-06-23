<?php

use \GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

if (!function_exists('convertCurrency')) {
    define("EXCHANGE_RATE", 'exchange_rate');
    function convertCurrency($from, $to, $amount)
    {

        if (Cache::has(EXCHANGE_RATE)) {
            $rate = Cache::get(EXCHANGE_RATE);
        } else {
            $rate = getExchangeRate($from, $to, $amount);
        }
        return $rate * $amount;

    }

    function getExchangeRate($from, $to, $amount)
    {

        $client = new Client();
        $response = $client->request('GET', 'https://currency-conversion-and-exchange-rates.p.rapidapi.com/convert', [
            'query' => [
                'to' => $to,
                'from' => $from,
                'amount' => $amount,
            ],
            'headers' => [
                'X-RapidAPI-Key' => '2808b41facmshec8c2d49afae353p16f12fjsn14f82ecebd6f',
                'X-RapidAPI-Host' => 'currency-conversion-and-exchange-rates.p.rapidapi.com',
            ],
        ]);
        $responseBody = $response->getBody()->getContents();
        $data = json_decode($responseBody, true);
        $rate = $data['info']['rate'];
        $time = 300; //5 minute

        Cache::put(EXCHANGE_RATE, $rate, $time);

        return $rate;
    }
}
