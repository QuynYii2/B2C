<?php

namespace App\Http\Controllers;

use App\Services\ApiServiceInterface;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use function Composer\Autoload\includeFile;

class SearchController extends Controller
{
    private $apiService, $dataProduct;

    public function __construct(ApiServiceInterface $apiService)
    {
        $this->apiService = $apiService;
    }
    public function searchProduct(Request $request) {
        $dropdownValue = $request->input('site');
        $text = $request->input('text');

        if ($dropdownValue == 'taobao') {
            $this->dataProduct = $this->apiService->getTaoBao($text);
        } elseif ($dropdownValue = '1688') {
            $this->dataProduct = $this->apiService->get1688($text);
        } elseif($dropdownValue = 'alibaba') {
            $this->dataProduct = $this->apiService->getAliBaBa($text);
        }

        return view('pages/search-result', [
            'data' => $this->dataProduct,
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
                'X-RapidAPI-Key' => '7b2135e174msh19d71786a52d326p108060jsn3bec55c24554'
            ]
        ]);

        $body = $response->getBody();
        $data = json_decode($body, true);

        return view('pages/detail-product', [
            'data' => $data,
        ]);
    }
}


