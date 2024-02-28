<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use Illuminate\Validation\Rule;


class AuthorController extends Controller
{
    public function index(){
        $authors = Author::all();

        return response()->json([
            'data' => $authors->map(function ($author) {
                return [
                    'id' => $author->id,
                    'AuthorName' => $author->name,
                    'AuthorBio' => $author->bio,
                ];
            }),
        ]);
    }
    public function show(Request $request){
        $id=$request->route('author');

        $author = Author::find($id);

        if ($author) {
            return [
                'id' => $author->id,
                'name' => $author->name,
                'bio' => $author->bio
            ];
        } else {
            return response()->json(['message' => 'Author not found'], 404);
        }
    }
    public function store(Request $request)
    {
        
            $authorRequest = $request->validate([
                'name' => 'required | min:1 | max:20 |' .Rule::unique('authors')->ignore($request->id),
                'bio' => 'required | min:1 '
            ],[
                'name.unique' => ':input はすでに登録されてる。',
                'name.required'=>'入力が必要。',
                'name.min'=>'最低1文字必要。',
                'name.max' =>'最大20文字。',
                'bio.required'=>'入力が必要。',
                'bio.min'=>'最低1文字必要。'
            ]);
            Author::create([
                'name' => $authorRequest['name'],
                'bio' => $authorRequest['bio'],
            ]);
            return response()->json('Author created');
        
       
    }
   
    public function update(Request $request){
        $id=$request->route('author');
        $author = Author::find($id);

        if (!$author) {
            return response()->json(['message' => 'Author not found'], 404);
        }

        $authorRequest = $request->validate([
            'name' => 'required | min:1 | max:20 |' .Rule::unique('authors')->ignore($id),
            'bio' => 'required | min:1 '
        ],[
            'name.unique' => ':input はすでに登録されてる。',
            'name.required'=>'入力が必要。',
            'name.min'=>'最低1文字必要。',
            'name.max' =>'最大20文字。',
            'bio.required'=>'入力が必要。',
            'bio.min'=>'最低1文字必要。'
        ]);
        
        Author::where('id', $id)->update([
            'name' => $authorRequest['name'],
            'bio' => $authorRequest['bio'],
        ]);
        return response()->json('Author updated');
    }
    public function destroy(Request $request){
        $id=$request->route('author');
        $author=Author::find($id);
        if (!$author) {
            return response()->json(['message' => 'Author not found'], 404);
        }
        $author->delete();

        return response()->json('Author deleted');
    }
}
