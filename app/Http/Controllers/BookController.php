<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Support\Facades\DB;  
use Illuminate\Support\Facades\Storage;

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
        $path = Storage::putFile('storage', $req->file('file'));
        dd($path);
        Book::create([
            'title'        => $req->title,
            'author_id'    => $req->authors,
            'category_id'  => $req->categories,
            'publisher_id' => $req->publishers,
            'description'  => $req->description,
            'publication'  => $req->publication,
            'imgUrl'       => $path
        ]);
        return back();
    }

    function list($id=null, $pub=null){
        if($id){
            $books = DB::table('books')
            ->where('books.author_id', '=', $id)
            ->join('publishers', 'books.publisher_id', '=','publishers.id')
            ->join('authors', 'books.author_id', '=','authors.id')
            ->join('categories', 'books.category_id', '=','categories.id')
            ->select('books.imgUrl','books.title', 'books.description', 'books.publication', 'publishers.publisher','categories.category', 'authors.Fname', 'authors.Lname')
            ->get();    
        }else if($pub){
            $books = DB::table('books')
            ->where('books.publisher_id', '=', $pub)
            ->join('publishers', 'books.publisher_id', '=','publishers.id')
            ->join('authors', 'books.author_id', '=','authors.id')
            ->join('categories', 'books.category_id', '=','categories.id')
            ->select('books.imgUrl', 'books.title', 'books.description', 'books.publication', 'publishers.publisher','categories.category', 'authors.Fname', 'authors.Lname')
            ->get();    
        }else{
            $books = DB::table('books')
            ->join('publishers', 'books.publisher_id', '=','publishers.id')
            ->join('authors', 'books.author_id', '=','authors.id')
            ->join('categories', 'books.category_id', '=','categories.id')
            ->select('books.imgUrl','books.title', 'books.description', 'books.publication', 'publishers.publisher','categories.category', 'authors.Fname', 'authors.Lname')
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
    function search(Request $req){
        $authors = DB::table('authors')
            ->where('Fname', 'like', '%'.$req->search.'%')
            ->orWhere('Lname', 'like', '%'.$req->search.'%')
            ->get();
        $books = DB::table('books')
            ->where('title', 'like', '%'.$req->search.'%')
            ->orWhere('description', 'like', '%'.$req->search.'%')
            ->get();

        return view('book.list', ['books'=>$books, 'authors'=>$authors]);
    }

}
