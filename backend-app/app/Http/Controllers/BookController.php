<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Book;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class BookController extends Controller
{
    public function index(){
       // $book = Book::all();
        $book = Book::with('author')->get();

        return response()->json([
            'data' => $book->map(function ($book) {
                return [
                    'id' => $book->id,
                    'title' => $book->title,
                    'author_id' => $book->author_id,
                    'author_name'=> isset($book->author) ? $book->author->name : null,
                    'genre' => $book->genre,
                    'published_date' => $book->published_date
                ];
            }),
        ]);
    }

    public function show(Request $request){        
        $id = $request->route('book');
        //$book = Book::find($id);
        $book = Book::with('author')->find($id); 
        if ($book) {
            return [
                'id' => $book->id,
                'title' => $book->title,
                'author_id' => $book->author_id,
                'author_name' => isset($book->author) ? $book->author->name : null,
                'genre' => $book->genre,
                'published_date' => $book->published_date
            ];
        } else {
            return response()->json(['message' => 'Book not found'], 404);
        }
    }

    //Notes:
    //unique:table name,column,ignore => books,title, . $request->id
    //.Rule::unique('books')->ignore($request->id)
    public function store(Request $request){
        //$parseDate = Carbon::parse($request->published_date);
        //$formattedDate = $parseDate->format('Y-m-d');
        $bookRequest = $request->validate([
            'title' => 'required | min:1 | max:99',
            'author_id' => 'required | exists:authors,id',
            'genre' => 'required',
            'published_date' => 'required | date:Y-m-d'
        ],[
            'title.required' =>'入力が必要。',
            'title.min'=>'最低1文字必要。',
            'title.max' =>'最大20文字。',
            'author_id.required' =>'入力が必要。',
            'author_id.exists'=>':input は見つからない。',
            'genre.required' =>'入力が必要。',
            'published_date.required' =>'入力が必要。'
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
            'title' => 'required|min:1|max:99|unique:books,title,' . $id,
            'author_id' => 'required|exists:authors,id',
            'genre' => '', 
            'published_date' => 'required|date',
        ],[
            'title.required' =>'入力が必要。',
            'title.min'=>'最低1文字必要。',
            'title.max' =>'最大20文字。',
            'author_id.required' =>'入力が必要。',
            'author_id.exists'=>':input は見つからない。',
            'genre.required' =>'入力が必要。',
            'published_date.required' =>'入力が必要。'
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
