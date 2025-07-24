<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
    protected $table = 'posts';

    protected $fillable = ['title', 'content', 'is_done'];
}
