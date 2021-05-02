<?php

namespace App\Http\Livewire;

use App\Models\Book;
use Livewire\Component;
use Livewire\WithPagination;

class Books extends Component{
    use WithPagination;

    //filter and sort
    public $search, $direction, $sort;

    public function mount() {
        $this->direction = 'asc';
        $this->sort = 'title';
    }

    public function render(){
        $books = Book::where('title', 'like', '%'.$this->search.'%')
        ->orWhere('genre', 'like', '%'.$this->search.'%')
        ->orWhere('summary', 'like', '%'.$this->search.'%')
        ->orWhere('isbn', 'like', '%'.$this->search.'%')
        ->orderBy($this->sort, $this->direction)
        ->paginate(12);
        return view('livewire.books', compact('books'));
    }

}
