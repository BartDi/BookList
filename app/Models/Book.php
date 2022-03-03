<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Author;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'description',
        'category_id',
        'author_id',
        'publisher_id',
        'publication'
    ];

    // function categories(){
    //     return $this->hasMany(Category::class, 'id');
    // }
    // function authors(){
    //     return $this->hasMany(Author::class, 'id');
    // }
    // function publishers(){
    //     return $this->hasMany(Publisher::class, 'id');
    // }
}
