<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $primaryKey = 'blog_id';
    protected $fillable = [
        'title',
        'slug',
        'user_id',
        'category_id',
        'content',
        'view_count',
        'comment_count',
        'thumbnail',
        'description',
    ];
}
