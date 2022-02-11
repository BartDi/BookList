<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


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
        return view('addBook');
    }

    //Function adds book to database, to userBooks table https://dev.to/wanjema/getting-started-with-laravel-and-vue-js-2hc6
    function addBook(){
        return view('list');
    }
}
