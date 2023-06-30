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
                'APIKey' => 'k_3176782f2ec0db9985ac0e770581a4f8	'
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
                'X-RapidAPI-Key' => 'b39e1a72a5msh6d1b69ec8c1f62bp188244jsn2924c2747d50'
            ]
        ]);

        $body = $response->getBody();
        $detailTaoBao = json_decode($body, true);

        return $detailTaoBao;
    }

    public function get1688($text)
    {
        // TODO: Implement get1688() method.
        $response = $this->client->request('GET', 'https://16881.p.rapidapi.com/api', [
            'query' => [
                'api' => 'item_search_1688',
            	'q' => $text,
            	'page_size' => '20',
            	'page' => '1',
            	'sort' => 'default',//sales_des, sales_asc, price_asc, price_des
            ],
            'headers' => [
                'X-RapidAPI-Host' => '16881.p.rapidapi.com',
                'X-RapidAPI-Key' => 'e5fec28adcmsh01ac8839654caf8p1731bbjsn4ee3310b5513'
            ]
        ]);
        
        $body = $response->getBody()->getContents();
        $search1688 = json_decode($body, true);

        return $search1688;
    }

    public function detail1688($id)
    {
        // TODO: Implement detail1688() method.
        $response = $this->client->request('GET', 'https://16881.p.rapidapi.com/api', [
            'query' => [
                'api' => 'item_detail_1688',
                'num_iid' => $id
            ],
            'headers' => [
                'X-RapidAPI-Key' => 'e5fec28adcmsh01ac8839654caf8p1731bbjsn4ee3310b5513',
                'X-RapidAPI-Host' => '16881.p.rapidapi.com'
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
