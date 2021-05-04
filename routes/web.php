<?php

use App\Http\Livewire\Book;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Test;
use App\Http\Livewire\Books;
use Illuminate\Support\Facades\Storage;
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


Route::get('/test', function() {
    echo Storage::url('public\images\books\88bbd880672b05ef2d0dedfeeae2ccb1.png');
});
