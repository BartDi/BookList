<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Support\Facades\DB;  


class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //function shows all user's books
    function show(){
        return view('list');
    }

    //Function which redirects to form
    function FormBook(){
        $categories = Category::all()->pluck('category', 'id');
        $authors = Author::select('id', DB::raw("CONCAT(Fname,' ',Lname) AS FullName"))->get()->pluck(('FullName'),'id' );
        $publishers = Publisher::all()->pluck('publisher', 'id');
        return view('book.addBook', [
            'categories'=>$categories, 
            'authors'=>$authors,
            'publishers'=>$publishers
        ]);
    }
    //Function adds book to database, to userBooks table https://dev.to/wanjema/getting-started-with-laravel-and-vue-js-2hc6
    function store(Request $req){
        $validator = $req->validate([
            'title' => 'required',
            'description' => 'required',
            'authors' => 'required|numeric',
            'publishers' => 'required|numeric',
            'publication' => 'required|numeric|min:1800|max:'.date("Y"),
            'categories' => 'required|numeric'
        ]);
        Book::create([
            'title'        => $req->title,
            'author_id'    => $req->authors,
            'category_id'  => $req->categories,
            'publisher_id' => $req->publishers,
            'description'  => $req->description,
            'publication'  => $req->publication
        ]);
        return back();
    }

    function list($id=null, $pub=null){
        if($id){
            $books = DB::table('books')
            ->where('books.author_id', '=', $id)
            ->rightJoin('publishers', 'books.publisher_id', '=','publishers.id')
            ->rightJoin('authors', 'books.author_id', '=','authors.id')
            ->rightJoin('categories', 'books.category_id', '=','categories.id')
            ->select('books.title', 'books.description', 'books.publication', 'publishers.publisher','categories.category', 'authors.Fname', 'authors.Lname')
            ->get();    
        }else if($pub){
            $books = DB::table('books')
            ->where('books.publisher_id', '=', $pub)
            ->rightJoin('publishers', 'books.publisher_id', '=','publishers.id')
            ->rightJoin('authors', 'books.author_id', '=','authors.id')
            ->rightJoin('categories', 'books.category_id', '=','categories.id')
            ->select('books.title', 'books.description', 'books.publication', 'publishers.publisher','categories.category', 'authors.Fname', 'authors.Lname')
            ->get();    
        }else{
            $books = DB::table('books')
            ->rightJoin('publishers', 'books.publisher_id', '=','publishers.id')
            ->rightJoin('authors', 'books.author_id', '=','authors.id')
            ->rightJoin('categories', 'books.category_id', '=','categories.id')
            ->select('books.title', 'books.description', 'books.publication', 'publishers.publisher','categories.category', 'authors.Fname', 'authors.Lname')
            ->get();
        }
        return view('book.list', ['books'=>$books]);
    }

    function authors(){
        return view('author.authors', ['authors'=>Author::all()]);
    }

    function categories(){
        return view('category.categories', ['categories'=>Category::sortable()->paginate()]);
    }

    function publishers(){
        return view('publisher.publishers', ['publishers' => Publisher::all()]);
    }
}
