<?php

namespace App\Repositories;

use GuzzleHttp\Client;

class GuzzleHttpRequest {

    protected $client;

    public function __construct(Client $client){
        $this->client = $client;
    }

    protected function get($url){
        $response = $this->client->request('GET', $url);
        return [
            'status' => $response->getStatusCode(),
            'body' => json_decode($response->getBody()->getContents(),
            true)
        ];
    }

}
