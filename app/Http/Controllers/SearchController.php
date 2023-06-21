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
        $currency = (new BaseController())->getLocation($request);
        $dropdownValue = $request->input('site');
        $text = $request->input('text');

        if ($dropdownValue == 'taobao') {
            $this->dataProduct = $this->apiService->getTaoBao($text);
        } elseif ($dropdownValue = '1688') {
            $this->dataProduct = $this->apiService->get1688($text);
        } elseif ($dropdownValue = 'alibaba') {
            $this->dataProduct = $this->apiService->getAliBaBa($text);
        }

        return view('pages/search-result', [
            'data' => $this->dataProduct,
            'nameProduct' => $text,
            'services' => $dropdownValue,
            'currency' => $currency
        ]);

    }

    public function getDetailProduct(Request $request, $service, $id)
    {
        $client = new Client();
        $currency = (new BaseController())->getLocation($request);

        $key = "b7211c2138msha0af71d7f60d97dp15b9b8jsn944d7ed17867";

        $response = $client->request('GET', 'https://taobao-tmall-16882.p.rapidapi.com/item_get', [
            'query' => [
                'provider' => $service,
                'num_id' => $id,
                'lang' => 'en',
                'is_promotion' => '1',
            ],
            'headers' => [
//                'Content-Type' => 'application/json',
//                'APIKey' => 'k_ea939e4a58469312b35d7c1db46c9c6a'
                'X-RapidAPI-Host' => 'taobao-tmall-16882.p.rapidapi.com',
                'X-RapidAPI-Key' => $key,
            ]
        ]);

        $body = $response->getBody();
        $data = json_decode($body, true);

        if ($service == 'taobao') {
            return view('pages/product_pages/detail-product-taobao', [
                'data' => $data,
                'currency' => $currency
            ]);
        } elseif ($service == '1688') {
            return view('pages/product_pages/detail-product-1688', [
                'data' => $data,
                'currency' => $currency
            ]);
        } elseif ($service == 'alibaba') {
            return view('pages/product_pages/detail-product-alibaba', [
                'data' => $data,
                'currency' => $currency
            ]);
        } else {
            return view('pages/detail-product', [
                'data' => $data,
                'currency' => $currency
            ]);
        }
    }
}


