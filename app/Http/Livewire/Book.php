<?php

namespace App\Http\Livewire;

use App\Models\Book as BookModel;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Book extends Component{
    use WithFileUploads;

    //props
    public BookModel $book;
    public $front_image, $back_image;

    //models
    public $open_edit, $open_delete, $openApi = false;

    public $rules = [
        'book.title' => 'required|string|max:255',
        'book.synopsys' => 'string|max:1000',
        'book.author' => 'required|string|max:255',
        'book.subject' => 'required|string|max:255',
        'book.publisher' => 'required|string|max:255',
        'book.isbn13' => 'required|numeric',
        'book.date_published' => 'required|min:4|date_format:Y'
    ];

    public function render(){
        return view('livewire.book');
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

}
