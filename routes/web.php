<?php

use App\Http\Livewire\Book;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Test;
use App\Http\Livewire\Books;
use App\Http\Controllers\BookController;
use App\Repositories\ApiBooks;
use App\Repositories\Books as RepositoriesBooks;
use GuzzleHttp\Client;

Route::view('/', 'welcome');

Route::middleware(['auth:sanctum', 'verified'])
->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::get('test', Test::class)->name('test');

    Route::prefix('books')->group(function () {
        Route::get('/', Books::class)->name('books');
        Route::get('/{book}', Book::class)->name('book');
    });

});


Route::get('/test', function() {
    /* $url = 'https://api2.isbndb.com/book/9788494510335';
    $restKey = '45965_2adb97b0d6cc20d38d9252e12b99fb32';

    $headers = array(
        "Content-Type: application/json",
        "Authorization: " . $restKey
    );

    $rest = curl_init();
    curl_setopt($rest, CURLOPT_URL, $url);
    curl_setopt($rest, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($rest, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($rest);

    //echo json_decode($response, true);
    $book = json_decode($response)->book;
    print_r($book->publisher);

    curl_close($rest); */

    /* $book = ModelsBook::where('id', 1)->get()->first();
    //$myJSON = json_encode($myObj);
    echo $book->id; */

    /* $client = new Client([
        'headers' => [
            'Content-Type' => 'application/json',
            'Authorization' => '45965_2adb97b0d6cc20d38d9252e12b99fb32',
        ],
        'base_uri' => 'https://api2.isbndb.com',
    ]);
    $isbn = '9788417079260';
    $response = $client->request('GET', 'book/'.$isbn);
    $json = json_decode($response->getBody()->getContents(), true);
    $json["book"]["status"] = $response->getStatusCode();
    $object = (object) $json["book"];
    return $json; */
    return view('test');
});

/* Route::get('test2', [BookController::class, 'index'])
->name('test2');
Route::get('test2/{isbn}', [BookController::class, 'show'])
->name('test2.show'); */

Route::get('test2', function (RepositoriesBooks $books) {
    //return var_dump($books->findByIsbn('9788494510335'));
    return var_dump(ApiBooks::findByIsbn('9788494510335'));
});
