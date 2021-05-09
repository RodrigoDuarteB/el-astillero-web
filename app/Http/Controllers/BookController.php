<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller {

    public function all(){
        try {
            $books = Book::all();
            if($books){
                return response()->json([
                    "count" => Book::count(),
                    "books" => $books
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                "status" => "failed",
                "message" => "Books not Found"
            ], 404);
        }
        return response()->json([
            "status" => "failed",
            "message" => "Something went wrong now!"
        ], 500);
    }


    public function getById($id){
        try {
            $book = Book::findOrFail($id);
            if($book){
                return response()->json($book);
            }
        } catch (\Throwable $th) {
            return response()->json([
                "status" => "failed",
                "message" => "Book not Found"
            ], 404);
        }
        return response()->json([
            "status" => "failed",
            "message" => "Something went wrong now!"
        ], 500);
    }


    public function create(Request $request){
        try {
            /* $request->validate([
                'title' => 'required|string|max:255',
                'summary' => 'string|max:100',
                'genre' => 'required|string|max:255',
                'author' => 'required|string|max:255',
                'publish_year' => 'required|date_format:Y',
                'publisher' => 'required|string|max:255',
                'front_image' => 'required|string|max:255',
                'back_image' => 'string|max:255',
                'isbn' => 'required|numeric|min:10|max:13|unique:books,isbn',
            ]); */
            $newBook = Book::create($request->all());
            if($newBook){
                return response()->json([
                    "status" => "ok",
                    "message" => "Book Created!",
                    "created" => $newBook
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                "status" => "failed",
                "message" => "Book not valid!"
            ], 400);
        }
        return response()->json([
            "status" => "failed",
            "message" => "Something went wrong now!"
        ], 500);
    }


    public function update(Request $request, $id){
        try {
            $book = Book::findOrFail($id);
            if($book){
                $book->update($request->all());
                return response()->json([
                    "status" => "ok",
                    "updated" => $book
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                "status" => "failed",
                "message" => "Book not Found"
            ], 404);
        }
        return response()->json([
            "status" => "failed",
            "message" => "Something went wrong now!"
        ], 500);
    }


    public function delete($id){
        try {
            $book = Book::findOrFail($id);
            if($book){
                $book->delete();
                return response()->json([
                    "status" => "ok",
                    "message" => "Book deleted!",
                    "deleted" => $book
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                "status" => "failed",
                "message" => "Book not Found"
            ], 404);
        }
        return response()->json([
            "status" => "failed",
            "message" => "Something went wrong now!"
        ], 500);
    }

}
