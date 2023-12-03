<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $primaryKey = 'comment_id';
    protected $fillable = [
        'name',
        'content',
        'parent_id',
        'user_id',
        'blog_id',
        'status'
    ];
}
