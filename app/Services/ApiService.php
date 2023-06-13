<?php

namespace App\Services;

use GuzzleHttp\Client;

class ApiService implements ApiServiceInterface
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param $text
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getTaoBao($text)
    {
        $response = $this->client->request('GET', 'https://api.taobao-scraping-api.com/taobao/searchItem', [
            'query' => [
                'pageNum' => '1',
                'q' => $text
            ],
            'headers' => [
                'Content-Type' => 'application/json',
                'APIKey' => 'k_5fd81d1f87b75c66b7f2e80f922e1dda'
            ]
        ]);

        $body = $response->getBody();
        $searchTaoBao = json_decode($body, true);

        return $searchTaoBao;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function detailTaoBao($id)
    {
        $response = $this->client->request('GET', 'https://taobao-tmall-16882.p.rapidapi.com/item_get', [
            'query' => [
                'provider' => 'taobao',
                'num_id' => $id,
                'lang' => 'en',
                'is_promotion' => '1',
            ],
            'headers' => [
                'X-RapidAPI-Host' => 'taobao-tmall-16882.p.rapidapi.com',
                'X-RapidAPI-Key' => '01d6366a6cmsh2ffddf98b1a9216p1225bdjsn8fa4fa929898'
            ]
        ]);

        $body = $response->getBody();
        $detailTaoBao = json_decode($body, true);

        return $detailTaoBao;
    }

    public function get1688($text)
    {
        $response = $this->client->request('GET', 'https://otapi-1688.p.rapidapi.com/BatchSearchItemsFrame', [
            'query' => [
                'language' => 'en',
                'framePosition' => '0',
                'frameSize' => '50',
                'ItemTitle' => $text
            ],
            'headers' => [
                'X-RapidAPI-Key' => 'db553f5e5amshb338708daa1685cp1702b5jsn70481f99e43d',
                'X-RapidAPI-Host' => 'otapi-1688.p.rapidapi.com'
            ]
        ]);

        $body = $response->getBody()->getContents();
        $search1688 = json_decode($body, true);

        return $search1688;
    }

    public function detail1688($id)
    {
        // TODO: Implement detail1688() method.
        $response = $this->client->request('GET', 'https://taobao-tmall-16882.p.rapidapi.com/item_get', [
            'query' => [
                'provider' => '1688',
                'num_id' => $id,
                'lang' => 'en',
                'is_promotion' => '1',
            ],
            'headers' => [
                'X-RapidAPI-Host' => 'taobao-tmall-16882.p.rapidapi.com',
                'X-RapidAPI-Key' => '14e8316501mshee42908e2dc0bd4p15dcfcjsnd7a6b11f9a0b'
            ]
        ]);

        $body = $response->getBody();
        $detail1688 = json_decode($body, true);

        return $detail1688;
    }

    /**
     * @param $text
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAliBaBa($text)
    {
        $response = $this->client->request('GET', 'https://ali-express1.p.rapidapi.com/search', [
            'query' => [
                'page' => '1',
                'query' => $text
            ],
            'headers' => [
                'X-RapidAPI-Host' => 'ali-express1.p.rapidapi.com',
                'X-RapidAPI-Key' => 'db553f5e5amshb338708daa1685cp1702b5jsn70481f99e43d',
            ],
        ]);

        $body = $response->getBody();
        $data = json_decode($body, true);

        return $data;
    }

    /**
     * @param $id
     * @return void
     */
    public function detailAliBaBa($id)
    {
        // TODO: Implement detailAliBaBa() method.
    }

}
