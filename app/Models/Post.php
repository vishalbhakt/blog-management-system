<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'content',
        'author_name',
        'featured_image',
        'user_id'
    ];
}
