<?php

namespace App\Repositories;

use Exception;

class Books extends GuzzleHttpRequest {

    public function all(){
        return $this->get('posts');
    }

    public function findByIsbn($isbn){
        try{
            $res = $this->get('book/'.$isbn);
            if($res["status"] == 200){
                $book = (object) $res["body"]["book"];
                return $book;
            }
        }catch(Exception $e){
            return false;
        }
    }

    public function getStats(){
        $res = $this->get('stats');
        if($res["status"] == 200){
            return $res['body'];
        }
        return false;
    }

}
