<?php

namespace App\Repositories;

use App\Libs\Tools\StringTool;
use GuzzleHttp\Client;

class ApiBooks extends Api {

    public static function findByIsbn($isbn){
        try {
            $client = new Client([
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => '45965_2adb97b0d6cc20d38d9252e12b99fb32',
                ],
                'base_uri' => 'https://api2.isbndb.com',
            ]);
            $response = $client->request('GET', 'book/'.$isbn);
            $json = json_decode($response->getBody()->getContents(), true);
            /* $object = (object) $json["book"];
            return $object; */
            return $json["book"];
        } catch (\Throwable $th) {
            return false;
        }
    }

    public static function getBest(Array $books){
        $best = [];
        $may = 0;
        foreach ($books as $book){
            $length = count($book);
            if($length > $may){
                $may = $length;
                $best = $book;
            }
        }
        /* return (object) $best; */
        return $best;
    }

    public static function findByTitle($title){
        try {
            $client = new Client([
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => '45965_2adb97b0d6cc20d38d9252e12b99fb32',
                ],
                'base_uri' => 'https://api2.isbndb.com',
            ]);
            $title = StringTool::replaceSpacesWith($title, '%20');
            $response = $client->request('GET',
            'books/'.$title.'?page=1&pageSize=50&beta=0');
            $json = json_decode($response->getBody()->getContents(), true);
            return self::getBest($json["books"]);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public static function getStats(){
        try {
            $client = new Client([
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => '45965_2adb97b0d6cc20d38d9252e12b99fb32',
                ],
                'base_uri' => 'https://api2.isbndb.com',
            ]);
            $response = $client->request('GET', 'stats');
            return (object) json_decode($response->getBody()->getContents(), true);
        } catch (\Throwable $th) {
            return false;
        }
    }

}
