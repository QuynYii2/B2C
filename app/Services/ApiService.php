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
                'APIKey' => 'k_37f21b63f78d6d3d9071371f01f5444a'
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
                'X-RapidAPI-Key' => '231c07007fmsh26451fdd4ad3d83p125123jsn32be11d5a279'
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
                'X-RapidAPI-Key' => '039f2a7faamshbd80c6354ad3e9bp188e5bjsn29e22531e480'
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


    public function convertCurrency($from, $to, $amount)
    {
        $response = $this->client->request('GET', 'https://api.apilayer.com/exchangerates_data/convert', [
            'query' => [
                'to' => $to,
                'from' => $from,
                'amount' => $amount,
            ],
            'headers' => [
                'Content-Type' => 'text/plain',
                'apikey' => 'FwDuSvp8PRBjTtudKWgv4qFF5jD0qijf',
            ],
        ]);

        $responseBody = $response->getBody()->getContents();
        $data = json_decode($responseBody, true);

        return $data['result'];
    }

}
