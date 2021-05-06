<?php

namespace App\Repositories;
use GuzzleHttp\Client;

class ApiBooks {

    public static function findByIsbn($isbn){
        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => '45965_2adb97b0d6cc20d38d9252e12b99fb32',
            ],
            'base_uri' => 'https://api2.isbndb.com',
        ]);
        $response = $client->request('GET', 'book/'.$isbn);
        if($response->getStatusCode() != 200){
            return false;
        }
        $json = json_decode($response->getBody()->getContents(), true);
        $object = (object) $json["book"];
        return $object;
    }

}
