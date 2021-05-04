<?php

namespace App\Http\Livewire;

use App\Models\Book;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Books extends Component{
    use WithPagination, WithFileUploads;

    //filter and sort
    public $search, $direction, $sort;

    /* new book */
    public $open_create = false;
    public $title, $summary, $genre, $author, $publish_year, $publisher, $front_image, $back_image, $isbn;

    public function mount() {
        $this->direction = 'asc';
        $this->sort = 'title';
    }

    public $listeners = ['render'];

    public $rules = [
        'title' => 'required|string|max:255',
        'summary' => 'string|max:1000',
        'genre' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'publish_year' => 'required|date_format:Y',
        'publisher' => 'required|string|max:255',
        'front_image' => 'required|image',
        'back_image' => 'image',
        'isbn' => 'required|numeric|unique:books,isbn',
    ];

    public function render(){
        $books = Book::where('title', 'like', '%'.$this->search.'%')
        ->orWhere('genre', 'like', '%'.$this->search.'%')
        ->orWhere('summary', 'like', '%'.$this->search.'%')
        ->orWhere('isbn', 'like', '%'.$this->search.'%')
        ->orderBy($this->sort, $this->direction)
        ->paginate(12);
        return view('livewire.books', compact('books'));
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function create(){
        $this->validate();
        $book = new Book();
        $book->title = $this->title;
        $book->summary = $this->summary;
        $book->genre = $this->genre;
        $book->author = $this->author;
        $book->publish_year = $this->publish_year;
        $book->publisher = $this->publisher;
        $book->isbn = $this->isbn;

        if($this->front_image){
            $front = $this->front_image->store('public/images/books');
            $book->front_image = substr($front, 20,
            strlen($front));
        }

        if($this->back_image){
            $back = $this->back_image->store('public/images/books');
            $book->back_image = substr($back, 20,
            strlen($back));
        }

        $book->save();
        $this->reset('open_create');
    }

}
