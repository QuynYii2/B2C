<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class AlibabaController extends Controller
{
    public function search(Request $request) {
        $text = $request->input('text');

        $client = new Client();

        $response = $client->request('GET', 'https://ali-express1.p.rapidapi.com/search', [
            'query' => [
                'page' => '1',
                'query' => $text
            ],
            'headers' => [
                'X-RapidAPI-Host' => 'ali-express1.p.rapidapi.com',
                'X-RapidAPI-Key' => 'e5fec28adcmsh01ac8839654caf8p1731bbjsn4ee3310b5513',
            ],
        ]);

        $body = $response->getBody();
        dd($body);
    }

    public function getDetailProduct(Request $request, $id) {
        $client = new Client();

        $response = $client->request('GET', 'https://taobao-tmall-16882.p.rapidapi.com/item_get', [
            'query' => [
                'provider' => 'taobao',
                'num_id' => $id,
                'lang' => 'en',
                'is_promotion' => '1',
            ],
            'headers' => [
//                'Content-Type' => 'application/json',
//                'APIKey' => 'k_ea939e4a58469312b35d7c1db46c9c6a'
                'X-RapidAPI-Host' => 'taobao-tmall-16882.p.rapidapi.com',
                'X-RapidAPI-Key' => '60b2ed8013msh5c0318853ce4f2ep178ad5jsn926b83d5fad1'
            ]
        ]);

        $body = $response->getBody();
        $data = json_decode($body, true);

        return view('pages/detail-product', [
            'data' => $data,
        ]);
    }
}


