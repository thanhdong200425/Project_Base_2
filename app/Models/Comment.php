<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'email',
        'website',
        'content',
        'parent_id',
        'user_id',
        'blog_id',
        'status',
        'created_at',
        'updated_at'
    ];
}
