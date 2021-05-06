<?php

namespace App\Http\Livewire;

use App\Models\Book as BookModel;
use App\Repositories\ApiBooks;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Book extends Component{
    use WithFileUploads;

    //props
    public BookModel $book;
    public $front_image, $back_image;

    //api
    protected $apiBook;
    public $isbn;

    public $open_edit, $open_delete, $open_api = false;

    public $rules = [
        'book.title' => 'required|string|max:255',
        'book.summary' => 'string|max:1000',
        'book.author' => 'required|string|max:255',
        'book.genre' => 'required|string|max:255',
        'book.publisher' => 'required|string|max:255',
        'book.isbn' => 'required|numeric',
        'book.publish_year' => 'required|min:4|date_format:Y',
        'apiBook.title' => 'required'
    ];

    public function render(){
        $api = $this->apiBook;
        return view('livewire.book', compact('api'));
    }

    public function update(){
        $this->validate();
        if($this->front_image){
            Storage::delete(['public/images/books/'.$this->book->front_image]);
            $new_front = $this->front_image->store('public/images/books');
            $this->book->front_image = substr($new_front, 20,
            strlen($new_front));
        }
        if($this->back_image){
            Storage::delete(['public/images/books/'.$this->book->back_image]);
            $new_back = $this->back_image->store('public/images/books');
            $this->book->back_image = substr($new_back, 20,
            strlen($new_back));
        }
        $this->book->save();
        $this->reset(['open_edit']);
    }

    public function delete(){
        Storage::delete(['public/images/books/'.$this->book->front_image, 'public/images/books/'.$this->book->back_image]);
        $this->book->delete();
        redirect()->route('books');
    }

    public function getByIsbn(){
        $this->apiBook = ApiBooks::findByIsbn($this->isbn);
    }

}
