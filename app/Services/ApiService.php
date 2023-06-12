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
                'APIKey' => 'k_7ce90489daab9f03fd3bccac1456c77b'
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
                'X-RapidAPI-Key' => '7b2135e174msh19d71786a52d326p108060jsn3bec55c24554'
            ]
        ]);

        $body = $response->getBody();
        $detailTaoBao = json_decode($body, true);

        return $detailTaoBao;
    }

    public function get1688($text)
    {
        // TODO: Implement get1688() method.
        $response = $this->client->request('GET', 'https://taobao-tmall-16882.p.rapidapi.com/item_search', [
            'query' => [
                'keyword' => $text,
                'start_price' => '0',
                'end_price' => '99999',
                'provider' => '1688',
                'sort' => '_sale',
                'page' => '20',
                'cat' => '0',
                'lang' => 'cn', // available value en,cn,ru
            ],
            'headers' => [
                'X-RapidAPI-Host' => 'taobao-tmall-16882.p.rapidapi.com',
                'X-RapidAPI-Key' => '7b2135e174msh19d71786a52d326p108060jsn3bec55c24554'
            ]
        ]);

        $body = $response->getBody();
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
                'X-RapidAPI-Key' => '7b2135e174msh19d71786a52d326p108060jsn3bec55c24554'
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
                'X-RapidAPI-Key' => 'a9007c5328mshf8e6b10b1bc9c8fp1ac418jsn7b82822017e8',
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