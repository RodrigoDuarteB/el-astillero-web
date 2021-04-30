<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Book;

class Books extends Component{

    public $books;

    public function mount() {
        $this->books = Book::all();
    }

    public function render(){
        return view('livewire.books', compact($this->books))
        ->layout('layouts.app', ['title' => 'Books']);
    }
}
