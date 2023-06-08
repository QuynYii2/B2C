<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class TaoBaoController extends Controller
{
    public function search(Request $request) {
        $text = $request->input('text');

        $client = new Client();

        $response = $client->request('GET', 'https://api.taobao-scraping-api.com/taobao/searchItem', [
            'query' => [
                'pageNum' => '1',
                'q' => $text
            ],
            'headers' => [
                'Content-Type' => 'application/json',
                'APIKey' => 'k_ea939e4a58469312b35d7c1db46c9c6a'
            ]
        ]);

        $body = $response->getBody();
        $data = json_decode($body, true);

        return view('pages/search-result', [
            'data' => $data,
            'nameProduct' => $text
        ]);

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


