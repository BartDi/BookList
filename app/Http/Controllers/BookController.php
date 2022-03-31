<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Support\Facades\DB;  
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

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
    function FormAuthor(){
        return view('author.add');
    }
    function storeAuthor(Request $req){
        $validator = $req->validate([
            'Fname' => 'required',
            'description' => 'required',
            'Lname' => 'required'
        ]);
        if ($req->file('author')->isValid()) {
            $path = $req->author->store('public/authors');
            $path = str_replace('public', '/storage', $path);
        }
        Author::create([
            'Fname' => $req->Fname,
            'Lname' => $req->Lname,
            'description' => $req->description,
            'img' => $path
        ]);

        return back();
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
        if ($req->file('cover')->isValid()) {
            $path = $req->cover->store('public/covers');
            $path = str_replace('public', '/storage', $path);
        }
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

    function list($id=null, $pub=null, $cat=null){
        if($id){
            $books = Book::sortable()
            ->where('books.author_id', '=', $id)
            ->join('publishers', 'books.publisher_id', '=','publishers.id')
            ->join('authors', 'books.author_id', '=','authors.id')
            ->join('categories', 'books.category_id', '=','categories.id')
            ->select('books.id','books.author_id', 'books.price','books.imgUrl','books.title', 'books.description', 'books.publication', 'publishers.publisher','categories.category', 'authors.Fname', 'authors.Lname')
            ->paginate(10);    
        }else if($pub){
            $books = Book::sortable()
            ->where('books.publisher_id', '=', $pub)
            ->join('publishers', 'books.publisher_id', '=','publishers.id')
            ->join('authors', 'books.author_id', '=','authors.id')
            ->join('categories', 'books.category_id', '=','categories.id')
            ->select('books.id','books.author_id','books.price','books.imgUrl', 'books.title', 'books.description', 'books.publication', 'publishers.publisher','categories.category', 'authors.Fname', 'authors.Lname')
            ->paginate(10); 
        }else if($cat){
            $books = Book::sortable()
            ->where('books.category_id', '=', $cat)
            ->join('publishers', 'books.publisher_id', '=','publishers.id')
            ->join('authors', 'books.author_id', '=','authors.id')
            ->join('categories', 'books.category_id', '=','categories.id')
            ->select('books.id','books.author_id','books.price','books.imgUrl', 'books.title', 'books.description', 'books.publication', 'publishers.publisher','categories.category', 'authors.Fname', 'authors.Lname')
            ->paginate(10);    
        }else{
            $books = Book::sortable()
            ->join('publishers', 'books.publisher_id', '=','publishers.id')
            ->join('authors', 'books.author_id', '=','authors.id')
            ->join('categories', 'books.category_id', '=','categories.id')
            ->select('books.amount', 'books.id','books.author_id','books.price','books.imgUrl','books.title', 'books.description', 'books.publication', 'publishers.publisher','categories.category', 'authors.Fname', 'authors.Lname')
            ->paginate(10);
        }
        return view('book.list', ['books' => $books]);
    }

    function product($id){
        $book = Book::findOrFail($id);
        $author = $book->author;
        return view('book.page', ['book' => $book, 'author' => $author]);
    }

    function save(Request $request)
    {

        switch($request->action){
            case 'add':
                $id = $request->id;
                $book = Book::findOrFail($id);
                $amount = 1;
                if($request->session()->has('bookss')){
                    foreach($request->session()->get('bookss') as $sesBook){
                        if($sesBook['id']==$id){
                            return redirect()->back()->with('information','Book was already added');
                        }
                    }
                }
                    $arrayBook = [
                        'id' => $book->id,
                        'title' => $book->title,
                        'imgUrl' => $book->imgUrl,
                        'price' => $book->price,
                        'amount' => $amount
                    ];
                    $request->session()->push('bookss', $arrayBook);  
                return redirect()->back()->with('succes','Book succesfuly added');
                break;
            case 'save':
                $data = DB::table('library')
                    ->where('book_id', '=', $request->id)
                    ->where('user_id', '=', Auth::id())->count();
                if($data>0){
                    return redirect()->back()->with('information','Book has already saved');
                }
                else{    
                    $query = DB::table('library')->insert([
                        'book_id' => $request->id,
                        'user_id' => Auth::id()
                    ]);
                    if($query){
                        return redirect()->back()->with('succes','Book saved');
                    }
                    else{
                        return redirect()->back()->with('information','Something went wrong');
                    }
                }
                break;
        }
    }

    function basket()
    {
        return view('book.basket');
    }

    function library()
    {
        $books = array();
        $lib = DB::table('library')
            ->where('user_id', '=', Auth::id())->get();
        foreach($lib as $book){
            array_push($books, Book::findOrFail($book->book_id));
        }
        return view('book.library', ['books'=>$books]);
    }

    // function updateAmount(Request $request)
    // {
    //     //dd($request->session()->get('bookss'), $request->amount, $request->id);
    //     foreach($request->session()->get('bookss') as $key => $book){
    //         if($request->session()->get('bookss')[$key]['id'] == $request->id){
    //             unset($request->session()->get('bookss')[$key]);
    //         }
    //     }
    //     dd($request->session()->get('bookss'));
    // }


}
