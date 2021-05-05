<?php

namespace App\Repositories;

class Books extends GuzzleHttpRequest {

    public function all(){
        return $this->get('posts');
    }

    public function findByIsbn($isbn){
        return $this->get('book/'.$isbn);
    }

    public function getStats(){
        return $this->get('stats');
    }

}
