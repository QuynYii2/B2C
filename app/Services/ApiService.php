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
                'APIKey' => 'k_e1eea3a3f081e4e248e8606cd12eccb7'
            ]
        ]);

        $body = $response->getBody();
        $product = json_decode($body, true);

        return $product;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function detailTaoBao($id)
    {
        // TODO: Implement detailTaoBao() method.
        $response = $this->client->request('GET', 'https://taobao-tmall-16882.p.rapidapi.com/item_get', [
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
                'X-RapidAPI-Key' => 'a9007c5328mshf8e6b10b1bc9c8fp1ac418jsn7b82822017e8'
            ]
        ]);

        $body = $response->getBody();
        $detail = json_decode($body, true);

        return $detail;
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
