<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index(){
        return response()->json('Author index Called');
    }
    public function store(Request $request){
        return response()->json('Author store Called');
    }
    public function show(Request $request){
        return response()->json('Author show Called');
    }
    public function update(Request $request){
        return response()->json('Author update Called');
    }
    public function destroy(Request $request){
        return response()->json('Author destroy Called');
    }
}
