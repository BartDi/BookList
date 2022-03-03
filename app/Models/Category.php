<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Category extends Model
{
    use HasFactory;

    use Sortable;

    protected $fillable = [ 'category' ];

	public $sortable = [
        'id', 
        'category',  
        'created_at', 
        'updated_at'];
}
