<?php

namespace App\Http\Controllers;

use App\Repositories\Books;
use Illuminate\Http\Request;

class BookController extends Controller{

    protected $books;

    public function __construct(Books $books){
        $this->books = $books;
    }

    public function index(){
        return $this->books->getStats();
    }

    public function show($isbn){
        return $this->books->findByIsbn($isbn);
    }

}
