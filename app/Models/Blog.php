<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blog';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'slug',
        'user_id',
        'blog_category_id',
        'content',
        'view_count',
        'comment_count',
        'thumbnail',
        'descr',
        'author',
        'created_at',
        'updated_at'
    ];
}
