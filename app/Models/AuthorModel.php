<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthorModel extends Model
{
    protected $table = 'authors';
    protected $fillable = ['name', 'bio'];

    public function books()
    {
        return $this->belongsToMany(BookModel::class, 'author_book', 'author_id', 'book_id');
    }
}
