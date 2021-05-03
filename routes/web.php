<?php

use App\Http\Livewire\Book;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Test;
use App\Http\Livewire\Books;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'welcome');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::get('test', Test::class)->name('test');

    Route::prefix('books')->group(function () {
        Route::get('/', Books::class)->name('books');
        Route::get('/{book}', Book::class)->name('book');
    });

});


Route::get('/test', function(){
    echo 'test';
});
