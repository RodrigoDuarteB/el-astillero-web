<?php

use App\Http\Livewire\Book;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Test;
use App\Http\Livewire\Books;
use App\Http\Controllers\BookController;
use App\Libs\Tools\StringTool;
use App\Repositories\ApiBooks;
use App\Repositories\Books as RepositoriesBooks;
use GuzzleHttp\Client;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Book as ModelsBook;

Route::view('/', 'welcome');

Route::view('prueba', 'test');

Route::middleware(['auth:sanctum', 'verified'])
->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::get('test', Test::class)->name('test');

    Route::prefix('books')->group(function () {
        Route::get('/', Books::class)->name('books');
        Route::get('/{book}', Book::class)->name('book');
    });
});

Route::get('test2', function (Client $client) {
    /* $isbn = '9788417079260';
    $response = $client->request('GET',
    'books/de%20amor%20y%20de%20sombra?page=1&pageSize=30&beta=0');
    $json = json_decode($response->getBody()->getContents(), true); */
    /* $json["book"]["status"] = $response->getStatusCode();
    $object = (object) $json["book"]; */
    //return $json["books"];
    //return var_dump(ApiBooks::findByIsbn('9789584503534'));
    //return var_dump(ApiBooks::getStats());
    //return var_dump(isset($novar));
    //return StringTool::replaceSpacesWith('de amor y de sombra', '%20');
    /* $url = "https://images.isbndb.com/covers/35/34/9789584503534.jpg";
    $info = pathinfo($url);
    $name = time().hash('sha256',$info["filename"]).'.'.$info["extension"];
    $contents = file_get_contents($url);
    Storage::put($name, $contents);
    return Storage::move($name, 'public/images/'.$name); */
    $array = ["image" => "hola", "other" => "hola"];
    return var_dump(isset($array["image"]));
    //return ModelsBook::where('isbn13', '9783326667682')->first();
});
