<?php

namespace App\Http\Livewire;

use App\Models\Book;
use App\Repositories\ApiBooks;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Books extends Component{
    use WithPagination, WithFileUploads;

    //filter and sort
    public $search, $direction, $sort, $totalRecords, $records;

    // url
    protected $queryString = [
        'records' => ['except' => '12'],
        'sort' => ['except' => 'title'],
        'direction' => ['except' => 'asc'],
        'search' => ['except' => '']
    ];

    /* new book */
    public $openCreate = false;
    public $title, $title_long, $isbn, $isbn13, $dewey_decimal, $binding, $publisher, $language, $date_published, $edition, $pages, $dimensions, $overview, $cover, $back, $excerpt, $synopsys, $author, $subject, $stock;

    /* from ISBNDB API */
    public $apiBook, $message;

    public $rules = [
        'title' => 'required|string|max:255',
        'title_long' => 'string|max:1000',
        'isbn' => 'required|integer|digits:10|unique:books,isbn',
        'isbn13' => 'required|integer|digits:13|unique:books,isbn13',
        'dewey_decimal' => 'required|max:255',
        'binding' => 'string|max:255',
        'publisher' => 'required|string|max:255',
        'language' => 'required|string|max:255',
        'date_published' => 'required|date',
        'edition' => 'string|max:255',
        'pages' => 'required|integer',
        'dimensions' => 'string|max:255',
        'overview' => 'string|max:1000',
        'cover' => 'image',
        'back' => 'image',
        'excerpt' => 'string|max:255',
        'synopsys' => 'required|string|max:1000',
        'author' => 'required|string|max:255',
        'subject' => 'required|string|max:255',
        'stock' => 'integer',
    ];

    public function mount() {
        $this->direction = 'asc';
        $this->sort = 'title';
        $this->records = '12';
    }

    public function render(){
        $this->totalRecords = Book::count();
        $books = Book::where('title', 'like', '%'.$this->search.'%')
        ->orWhere('subject', 'like', '%'.$this->search.'%')
        ->orWhere('synopsys', 'like', '%'.$this->search.'%')
        ->orWhere('isbn', 'like', '%'.$this->search.'%')
        ->orWhere('isbn13', 'like', '%'.$this->search.'%')
        ->orWhere('author', 'like', '%'.$this->search.'%')
        ->orderBy($this->sort, $this->direction)
        ->paginate($this->records);
        return view('livewire.books', compact(['books']));
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function create(){
        $this->validate();

        $book = new Book();
        $book->isbn13 = $this->isbn13;
        $book->title = $this->title;
        $book->title_long = $this->title_long;
        $book->isbn = $this->isbn;
        $book->dewey_decimal = $this->dewey_decimal;
        $book->binding = $this->binding;
        $book->publisher = $this->publisher;
        $book->language = $this->language;
        $book->date_published = $this->date_published;
        $book->edition = $this->edition;
        $book->pages = $this->pages;
        $book->dimensions = $this->dimensions;
        $book->overview = $this->overview;
        $book->excerpt = $this->excerpt;
        $book->synopsys = $this->synopsys;
        $book->author = $this->author;
        $book->subject = $this->subject;

        if($this->cover){
            $front = $this->cover->store('public/images/books');
            $book->cover = substr($front, 20,
            strlen($front));
        }else if (isset($this->apiBook["image"])){
            $url = $this->apiBook["image"];
            $info = pathinfo($url);
            $name = time().hash('sha256',$info["filename"]).'.'
            .$info["extension"];
            $contents = file_get_contents($url);
            Storage::put($name, $contents);
            Storage::move($name, 'public/images/books/'.$name);
            $book->cover = $name;
        }

        if($this->back){
            $back = $this->back->store('public/images/books');
            $book->back = substr($back, 20,
            strlen($back));
        }

        if($this->stock){
            $book->stock = $this->stock;
        }
        $book->save();
        $this->reset('openCreate');
    }

    public function updatedIsbn13(){
        $this->reset(['message', 'apiBook']);
        $this->validate([
            'isbn13' => 'required|integer|digits:13'
        ]);

        /* Verify first if the book exists by isbn13 */
        $exists = Book::where('isbn13', $this->isbn13)->first();
        if($exists){
            $stock = $exists->stock;
            $exists->stock = ++$stock;
            $exists->save();
            $this->message = 'Se actualizo el stock del libro con isbn13 '.$exists->isbn13;
        }else{
            $this->apiBook = ApiBooks::findByIsbn($this->isbn13);
            if($this->apiBook){
                $this->title = isset($this->apiBook["title"]) ? $this->apiBook["title"] : null;
                $this->title_long = isset($this->apiBook["title_long"]) ? $this->apiBook["title_long"] : null;
                $this->isbn = isset($this->apiBook["isbn"]) ? $this->apiBook["isbn"] : null;
                $this->dewey_decimal = isset($this->apiBook["dewey_decimal"]) ? $this->apiBook["dewey_decimal"] : null;
                $this->binding = isset($this->apiBook["binding"]) ? $this->apiBook["binding"] : null;
                $this->publisher = isset($this->apiBook["publisher"]) ? $this->apiBook["publisher"] : null;
                $this->language = isset($this->apiBook["language"]) ? $this->apiBook["language"] : null;
                $this->date_published = isset($this->apiBook["date_published"]) ? $this->apiBook["date_published"] : null;
                $this->edition = isset($this->apiBook["edition"]) ? $this->apiBook["edition"] : null;
                $this->pages = isset($this->apiBook["pages"]) ? $this->apiBook["pages"] : null;
                $this->dimensions = isset($this->apiBook["dimensions"]) ? $this->apiBook["dimensions"] : null;
                $this->overview = isset($this->apiBook["overview"]) ? $this->apiBook["overview"] : null;
                $this->excerpt = isset($this->apiBook["excerpt"]) ? $this->apiBook["excerpt"] : null;
                $this->synopsys = isset($this->apiBook["synopsys"]) ? $this->apiBook["synopsys"] : null;
                $this->author = isset($this->apiBook["author"]) ? $this->apiBook["author"] : null;
                $this->subject = isset($this->apiBook["subject"]) ? $this->apiBook["subject"] : null;
            }else{
                $this->message = "No se encontró el libro por el isbn.. Registre manualmente";
            }
        }
    }

    public function updatedOpenCreate(){
        $this->reset(['isbn13', 'apiBook', 'message', 'cover', 'back']);
    }

    /* public function updated($propertyName){
        $this->validateOnly($propertyName);
    } */

}
