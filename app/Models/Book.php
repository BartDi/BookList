<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Author;
use Kyslik\ColumnSortable\Sortable;

class Book extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'title', 
        'description',
        'category_id',
        'author_id',
        'publisher_id',
        'publication',
        'imgUrl'
    ];

    protected $sortable = [
        'title', 
        'category_id',
        'author_id',
        'publisher_id',
        'publication',
    ];

    function author(){
        return $this->hasOne(Author::class, 'id', 'author_id')->select('Fname', 'Lname');
    }
}
