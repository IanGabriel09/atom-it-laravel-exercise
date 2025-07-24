<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookModel extends Model
{
    protected $table = 'books';
    protected $fillable = ['title', 'description', 'published_year'];

    public function authors()
    {
        return $this->belongsToMany(AuthorModel::class, 'author_book', 'book_id', 'author_id');
    }
}
