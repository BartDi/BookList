<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
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
    return view('home');
});
Route::get('/home', function () {
    return view('home');
});
Route::controller(BookController::class)->group(function (){
    Route::get('/list', 'list');
    Route::get('/add', 'FormBook');
    Route::post('/storeBook', 'store');
    Route::get('/categories', 'categories');
    Route::get('/authors', 'authors');
    Route::get('/author/books/{id}', 'list');
    Route::get('/publishers', 'publishers');
    Route::get('/publisher/{pub}', 'list');
    Route::post('/search', 'search');
});
Auth::routes();

