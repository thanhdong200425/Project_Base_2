<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog_Category extends Model
{
    use HasFactory;
    protected $table = 'blog_categories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'slug',
        'user_id',
        'created_at',
        'updated_at'
    ];
}
