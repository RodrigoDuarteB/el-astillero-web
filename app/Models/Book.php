<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model{
    use HasFactory;

    protected $fillable = ['title', 'title_long', 'isbn', 'isbn13', 'dewey_decimal', 'binding', 'publisher', 'language', 'date_published', 'edition', 'pages', 'dimensions', 'overview', 'cover', 'back', 'excerpt', 'synopsys', 'author', 'subject', 'stock'];
    public $timestamps = false;
}
