<?php

namespace App\Http\Controllers;

use App\Enums\StatisticStatus;
use App\Models\StatisticOrderSearch;
use App\Services\ApiServiceInterface;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use function Composer\Autoload\includeFile;

class SearchController extends Controller
{
    private $apiService, $dataProduct;

    public function __construct(ApiServiceInterface $apiService)
    {
        $this->apiService = $apiService;
    }

    public function searchProduct(Request $request)
    {
        $currency = (new BaseController())->getLocation($request);
        $dropdownValue = $request->input('site');
        $text = $request->input('text');

        if ($dropdownValue == 'taobao') {
            $this->dataProduct = $this->apiService->getTaoBao($text);
        } elseif ($dropdownValue == '1688') {
            $this->dataProduct = $this->apiService->get1688($text);
        } elseif ($dropdownValue == 'alibaba') {
            $this->dataProduct = $this->apiService->getAliBaBa($text);
        }

        $statisticSearch = StatisticOrderSearch::where([
            ['user_id', Auth::user()->id],
            ['status', StatisticStatus::ACTIVE],
            ['service', $dropdownValue]
        ])->first();

        if ($statisticSearch) {
            $statisticSearch->statistic_search = $statisticSearch->statistic_search + 1;
            $statisticSearch->save();
        } else {
            $item = [
                'user_id' => Auth::user()->id,
                'statistic_order' => 0,
                'statistic_search' => 1,
                'service' => $dropdownValue,
            ];
            StatisticOrderSearch::create($item);
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

        $key = "b39e1a72a5msh6d1b69ec8c1f62bp188244jsn2924c2747d50";

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


