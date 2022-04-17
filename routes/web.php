<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\FeaturesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Auth\LoginController;
use App\Mail\MailtrapExample;
use Illuminate\Support\Facades\Mail;


 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function(){
    return view('home')->name('home');;
});
Route::get('/home', function () {
    return view('home');
});
Route::controller(BookController::class)->group(function (){
    Route::get('/list', 'list')->name('list');
    Route::get('/add', 'FormBook');
    Route::post('/storeBook', 'store');
    Route::get('/author/books/{id}', 'list');
    Route::get('/category/{cat}', 'list');
    Route::get('/publisher/{pub}', 'list');
    Route::get('product/{id}', 'product');
    Route::get('add/author', 'FormAuthor');
    Route::post('/storeAuthor', 'storeAuthor');
    Route::post('/save', 'save');
    Route::get('/basket', 'basket');
    Route::get('/library', 'library');
    Route::get('/book/{id}', 'product');
});
Route::controller(FeaturesController::class)->group(function (){
    Route::get('/categories', 'categories');
    Route::get('/publishers', 'publishers');
    Route::get('author/{id}', 'author');
    Route::get('/authors', 'authors');
    Route::post('/search', 'search');
});
Route::get('/changeName', function(){
    return view('changes');
});
Route::controller(UsersController::class)->group(function(){
    Route::post('/userChangeName', 'changeUserName');
});
Auth::routes();
Route::get('login/auth/redirect', [LoginController::class, 'redirectToProvider'])->name('login.google');
 
Route::get('login/auth/callback', [LoginController::class, 'handleProviderCallback']);

