<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use Kyslik\ColumnSortable\Sortable;

class Author extends Model
{
    use HasFactory, Sortable;
    protected $fillable = [
        'Fname',
        'Lname',
        'description',
        'img'
    ];

    protected $sortable = [
        'Fname',
        'Lname',
        'description'
    ];


    function books(){
        return $this->hasMany(Book::class, 'author_id', 'id');
    }

    function booksInfo(){
        return $this->hasMany(Book::class, 'author_id', 'id')->select('title', 'description', 'imgUrl', 'id');
    }

}
