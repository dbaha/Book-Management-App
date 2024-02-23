<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Book;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    public function index(){
        $book = Book::all();

        return response()->json([
            'data' => $book->map(function ($book) {
                return [
                    'id' => $book->id,
                    'Title' => $book->title,
                    'AuthorId' => $book->author_id,
                    'Genre' => $book->genre,
                    'PublishedDate' => $book->published_date
                ];
            }),
        ]);
    }

    public function show(Request $request){
        $id=$request->route('book');
        
        $book = Book::find($id);

        if ($book) {
            return [
                'id' => $book->id,
                'Title' => $book->title,
                'AuthorId' => $book->author_id,
                'Genre' => $book->genre,
                'PublishedDate' => $book->published_date
            ];
        } else {
            return response()->json(['message' => 'Author not found'], 404);
        }
    }
    //Notes:
    //unique:table name,column,ignore => books,title, . $request->id
    //.Rule::unique('books')->ignore($request->id)
    public function store(Request $request){
        $bookRequest = $request->validate([
            'title' => 'required | min:1 | max:20',
            'author_id' => 'required | exists:authors,id',
            'genre' => 'required',
            'published_date' => 'required | date',
        ],[
            'author_id.exists'=>'ga ada anjing author nya'
        ]);
        Book::create([
            'title' => $bookRequest['title'],
            'author_id' => $bookRequest['author_id'],
            'genre' => $bookRequest['genre'],
            'published_date' => $bookRequest['published_date'],
        ]);
        return response()->json('Book created');
    }

    public function update(Request $request)
    {
        $id=$request->route('book');
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $bookRequest = $request->validate([
            'title' => 'required|min:1|max:20|unique:books,title,' . $id,
            'author_id' => 'required|exists:authors,id',
            'genre' => '', 
            'published_date' => 'required|date',
        ]);

        $book->update([
            'title' => $bookRequest['title'],
            'author_id' => $bookRequest['author_id'],
            'genre' => $bookRequest['genre'],
            'published_date' => $bookRequest['published_date'],
        ]);

        return response()->json('Book updated');
    }

    public function destroy(Request $request){
        $id=$request->route('book');
        $book=Book::find($id);
        if (!$book) {
            return response()->json(['message' => 'Author not found'], 404);
        }
        $book->delete();

        return response()->json('Book deleted');
    }

}
