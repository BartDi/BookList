<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Author;
use Illuminate\Support\Facades\DB;  

class FeaturesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function categories(){
        return view('category.categories', ['categories'=>Category::sortable()->paginate(30)]);
    }

    function publishers(){
        return view('publisher.publishers', ['publishers' => Publisher::all()]);
    }

    function author($id){
        $author = Author::findOrFail($id);
        $books = $author->booksInfo; 
        return view('author.page', ['author' => $author, 'books' => $books]);
    }

    function authors(){
        return view('author.authors', ['authors'=>Author::sortable()->paginate(20)]);
    }

    function search(Request $req){
        $authors = DB::table('authors')
            ->where('Fname', 'like', '%'.$req->search.'%')
            ->orWhere('Lname', 'like', '%'.$req->search.'%')
            ->get();
        $books = DB::table('books')
            ->where('title', 'like', '%'.$req->search.'%')
            ->orWhere('description', 'like', '%'.$req->search.'%')
            ->get();

        return view('layouts.result', ['books'=>$books, 'authors'=>$authors]);
    }

}
