<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model{
    use HasFactory;

    protected $fillable = ['title', 'summary', 'genre', 'author', 'publish_year', 'publisher', 'front_image', 'back_image', 'isbn'];
    public $timestamps = false;
}
